function note_touch(){
    document.addEventListener('DOMContentLoaded', function () {
        const notes = document.querySelectorAll('.sticky_note');

        notes.forEach(note => {
            note.addEventListener('click', function handleClick(event) {

                const id = note.getAttribute('data-id');
                if (!event.target.classList.contains('button_delete')){
                    editNoteContent(note, id);
                }
            });
        });
    });

}

function editNoteContent(note, id) {
    const titleConteiner = note.querySelector('h2');
    const textConteiner = note.querySelector('p');


    if (titleConteiner && textConteiner){
        const originalTitle = titleConteiner.textContent;
        const originalText = textConteiner.textContent;

        note.innerHTML =
            '<div class="edit_form">' +
            '<input type="text" class="title" value="' + originalTitle + '" >' +
            '<textarea rows="6" class="text"  >' + originalText + ' </textarea>' +
            '</div>';

        document.addEventListener('click', function listen(event) {
            const target = event.target;

            if (!target.closest('.sticky_note, h2, p, .button_user')) {
                const modifiedTitle = note.querySelector('.title').value;
                const modifiedText = note.querySelector('.text').value;
                document.removeEventListener('click', listen);

                saveEdit(id, modifiedTitle, modifiedText);
            }

        });
    }
}

async function saveEdit(id, modifiedTitle, modifiedText){

    fetch('fetch_notes.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({
            id: id,
            title: modifiedTitle,
            text: modifiedText,
        })
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // console.log('Data received',data);

            const note = document.querySelector('.sticky_note[data-id="' + id + '"]');
            const editForm = note.querySelector('.edit_form');

            if (editForm) {
                editForm.remove();
            }
            note.innerHTML =
                '<h2>' + modifiedTitle + '</h2>' +
                '<p>'+ data.text +'</p>' +
                '<input type="hidden" class="id" name="note_id" value="' + id + '">' +
                '<input class="button_delete" value="Delete" name="delete" type="submit">'

            note.addEventListener('click', function handleClick(event) {
                const id = note.getAttribute('data-id');
                if (!event.target.classList.contains('button_delete')) {
                    editNoteContent(note, id);
                }
            });
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}




