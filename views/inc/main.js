try {
//     const form = document.querySelector('form'),
//     input = document.querySelectorAll('input');
//     const cont = document.querySelector('.container');

// const postData = async (url, data) =>{
//     let res = await fetch(url, {
//         method: "POST",
//         body: data,
//     });
//     return await res.text();
// }

// const clearInp = () =>{
//     input.forEach(item =>{
//         item.value = '';
//     })
// }

// form.addEventListener('submit', (e) =>{
//     e.preventDefault();

//     const formData = new FormData(form);

//     postData("register.php", formData)
//     // вывод обычного текстового уведомления
//     // .then(res =>{
//     //     console.log(res)
//     // })

//     // обработка ответа json
//     .then(res => {
//         const data = JSON.parse(res);
//         if (data.status === 'success') {
//             window.location.href = data.redirect;
//         } else if (data.status === 'error') {
//              // если ошибка перезагружаем страницу, чтобы показать ошибки с сервера из массива SESSION
//             window.location.href = data.redirect;

//             // пример с выводом ошибок которые прислал сервер 
//             // в ответ мы получили объект с ошибками 
            
//             //  Object.keys(data.errors).forEach(item =>{
//             //     const messages = data.errors[item];
                
//             //     messages.forEach(el =>{
//             //         const errorElement = document.createElement('div');
//             //         errorElement.className = 'alert alert-danger'; // Примените нужный класс для стилизации
//             //         errorElement.textContent = el;
//             //         form.appendChild(errorElement);
//             //     })
//             //  })
           
//         }
//     })
    
//     .catch(() =>{
//         console.log('Ошибка')
//     })
//     .finally(() =>{
//         setTimeout(() =>{
//             clearInp();
//         },2000)
//     })
// })
const form = document.getElementById('form');
const input = document.querySelectorAll('[data="inp"]');

const message = {
    loading: 'Идет Отправка письма',
    done: 'Письмо отправлено, Скоро мы с вами свяжемся!',
    fail: 'Что то пошло не так'
}
const postData = async (url, data) =>{
    let res = await fetch(url, {
        method: "POST",
        body: data,
    });
    return await res.text();
}

const clearInp = () =>{
    input.forEach(item =>{
        item.value = '';
    })
}

form.addEventListener('submit', (e) =>{
    e.preventDefault();
    const formData = new FormData(form);
    
    let statusMessag = document.createElement('div');
    statusMessag.classList.add('status');
    form.parentNode.appendChild(statusMessag);
    let textMessage = document.createElement('div');
    textMessage.textContent = message.loading;
    statusMessag.appendChild(textMessage);

    setTimeout(() =>{
        // form.style.display = 'none';
        form.style.opacity = '0';
    },0)

    postData('php_mailer.php', formData)
    .then(response  =>{
        textMessage.textContent = message.done;
    })
    .catch(()=>{
        textMessage.textContent = message.fail;
        console.log('Ошибка')
    })
    .finally(() =>{
        setTimeout(() =>{
            clearInp();
            // form.style.display = 'block';
            form.style.opacity = '1';
            textMessage.textContent = ''
        },2500)
    })
})



}catch(er){}


// =================== убрать ошибку регистрации 

const parenError = document.querySelectorAll('[data="aler"]');
console.log(parenError)
if(parenError){
    parenError.forEach(item =>{
        setTimeout(() =>{
            item.style.display = 'none';
        },3000)
    })
    
}

