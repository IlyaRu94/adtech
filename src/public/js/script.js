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
            return await response.text();
        };

        if(e.target.tagName=='A'){
            action=e.target.href;
            if(action.indexOf("/admin/logout")>= 0){window.location('/')}
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
    ajaxSend(formData)
        .then((response) => {
            isJSON(response);
        })
        //.catch((err) => document.location.href = '/')
        .catch((err) => console.log(err))
}
function isJSON(str) {
    try {
        let resp=JSON.parse(str);
        //console.log(JSON.parse(str));//убрать
            resp.block.forEach(function(blockhtml,key) {
                document.querySelector(blockhtml).outerHTML=resp.html[key];
            });
        return (JSON.parse(str) && !!str);
    } catch (e) {
        //console.log(str)//убрать
        document.querySelector('.section').outerHTML=str;
        return false;
    }
}


})