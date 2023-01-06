bt1 = document.querySelector('.btncheck1');
bt2 = document.querySelector('.btncheck2');
bt3 = document.querySelector('.btncheck3');
const xhr = new XMLHttpRequest();

bt1.addEventListener('click', function() {

    if (this.checked) {
      var interval = setInterval(function(){xhr.open('GET', '/backups.php'); xhr.send();}, 30000);//every 30seconds 
    } else {
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
