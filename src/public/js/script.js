document.addEventListener("DOMContentLoaded", () => {
    var pagemain=document.querySelector(".page");
    pagemain.addEventListener("click", (e) => {
        let attr='';
        let param='';

        const ajaxSend = async (formData) => {
            const response = await fetch(action, {
                method: "POST",
                body: formData
            });
            if (!response.ok) {
                throw new Error(`Ошибка по адресу ${url}, статус ошибки ${response.status}`);
            }
            return await response.json();
        };

        if(e.target.tagName=='A'){
            action=e.target.href;
            document.querySelector("title").text=e.target.text;
            window.history.pushState({},'',action);
            e.preventDefault();
            let myform = document.createElement("form");
            sendtoform(ajaxSend,myform);
        }

        if(e.target.type=='submit' || e.target.tagName=='BUTTON'){
            let clicktarget=e.target; 
            let form=clicktarget.closest("form");
            if(clicktarget.tagName=='BUTTON'){
                attr=clicktarget.name;
                param=clicktarget.value;
            }else{
                attr='';param='';
            }
            action=form.action;
            e.preventDefault();
            sendtoform(ajaxSend,form,attr,param);

        }

    })


function sendtoform(ajaxSend,form,attr,param){
    const formData = new FormData(form);
    if(attr){
        formData.set(attr,param);
    }
    formData.set('json','json');
    console.log(form);
    ajaxSend(formData)
        .then((response) => {
            response.block.forEach(function(block,key) {
                document.querySelector(block).outerHTML=response.html[key];
            });
        })
        .catch((err) => document.location.href = '/')
}


})