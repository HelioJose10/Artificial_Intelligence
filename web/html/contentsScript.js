//tablebody = document.getElementById('tablebody');
tablebody = document.querySelector(".tablebody");
window.onload = function() {

    var xhr = new XMLHttpRequest();

    xhr.open('GET', '/listAll.php');
    
    xhr.onload = function() {
      tablebody.innerHTML = xhr.responseText;
    };
    xhr.send();

};
    
