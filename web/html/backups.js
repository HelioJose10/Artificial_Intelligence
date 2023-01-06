bt1 = document.getElementById('btncheck1');
bt2 = document.getElementById('btncheck2');
bt3 = document.getElementById('btncheck3');
const xhr = new XMLHttpRequest();
var flag = false;
bt1.addEventListener('click', function() {

    if (this.checked) {
      flag = true;
      var interval = setInterval(function(){xhr.open('GET', '/backups.php'); xhr.send();}, 30000);//every 30seconds 
    } else {
      flag = false;
      clearInterval(interval);
    }

});

bt2.addEventListener('click', function() {

    if (this.checked) {
      var interval = setInterval(function(){xhr.open('GET', '/backups.php'); xhr.send();}, 60000);//every 60seconds 
    } else {
      clearInterval(interval);
    }

});

bt3.addEventListener('click', function() {

    if (this.checked) {
      var interval = setInterval(function(){xhr.open('GET', '/backups.php'); xhr.send();}, 1000);//every 1seconds 
    } else {
      clearInterval(interval);
    }

});
