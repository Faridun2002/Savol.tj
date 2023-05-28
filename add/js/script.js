"use strict"

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('form');
    const body = document.getElementById('body');
    const formFile = document.getElementById('files');
    form.addEventListener('submit', formSend);
    
    async function formSend(e) {
        e.preventDefault();       
        
        let error = formValidate(form);

        if (error === 0) {
            let formData = new FormData(form);
            // formData.append('files', formFile.files);

            body.classList.add('_sending');
            
            let response = await fetch('addQ.php', {
                method: 'POST',
                body: formData
            });
            if(response.ok){
                let result = await response.json();
                alert(result.message);
                $('.input-file-list').empty();
                form.reset();
                body.classList.remove('_sending');
                window.location.href = "http://example.com";
            } else {
                alert("Ошибка попробуйте ещё раз.");
                $('.input-file-list').empty();
                form.reset();
                body.classList.remove('_sending');
            }
        } else {
            alert("Заполните обязательное поля");
        }
    }
    
    function formValidate(form) {
        let error = 0;
        let formReq = document.querySelectorAll('._req');
        
        for (let index = 0; index < formReq.length; index++) {
            const input = formReq[index];
            formRemoveError(input);
            
            if(input.getAttribute("type") === "checkbox" && input.checked === false) {
                formAddError(input);
                error++;
            }else {
                if (input.value === '') {
                    formAddError(input);
                    error++;
                }
            }
        }
        return error;
    }
    // добавляет родителю класс error
    function formAddError(input) {
        input.parentElement.classList.add('_error')
        input.classList.add('_error')
    }
    // убирает родителю класс error
    function formRemoveError(input) {
        input.parentElement.classList.remove('_error')
        input.classList.remove('_error')    
    }
});


var dt = new DataTransfer();
 
$('.input-file input[type=file]').on('change', function(){
	let $files_list = $(this).closest('.input-file').next();
	$files_list.empty();
 
	for(var i = 0; i < this.files.length; i++){
        if(this.files[i].size > 20 * 1024 * 1024) {
            alert('Файл должен быть меньше 20мб.');
            return;
        }
		let new_file_input = '<div class="input-file-list-item">' +
			'<span class="input-file-list-name">' + this.files.item(i).name + '</span>' +
			'<a href="#" onclick="removeFilesItem(this); return false;" class="input-file-list-remove">x</a>' +
			'</div>';
		$files_list.append(new_file_input);
		dt.items.add(this.files.item(i));
	};
	this.files = dt.files;
});
 
function removeFilesItem(target){
	let name = $(target).prev().text();
	let input = $(target).closest('.input-file-row').find('input[type=file]');	
	$(target).closest('.input-file-list-item').remove();	
	for(let i = 0; i < dt.items.length; i++){
		if(name === dt.items[i].getAsFile().name){
			dt.items.remove(i);
		}
	}
	input[0].files = dt.files;  
}