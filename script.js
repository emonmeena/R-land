function rate(str, bool){
    var ele = document.getElementById(str);
    var xmlhttp = new XMLHttpRequest();
    if(bool){
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                ele.innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","rate.php?qup="+str+"&qud=",true);
        xmlhttp.send();

    }else{
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                ele.innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","rate.php?qup="+"&qud="+str,true);
        xmlhttp.send();
    }
}

function comment(username, question){
    var section = document.getElementById("comment"+question);
    section.style.display = "block";
    var comment = document.getElementById("comment").value;
    document.getElementById("comment").value = "";
    var place =document.getElementById("place");
   var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            place.innerHTML = comment;
        }
    };
    xmlhttp.open("GET","comment.php?question="+question+"&comment="+comment+"&username="+username,true);
    xmlhttp.send();
}

function viewall(){
    
   var ele =   document.getElementById('view-all-btn');
}