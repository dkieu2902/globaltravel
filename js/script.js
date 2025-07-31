  /* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
  if (document.body.scrollTop > 190  || document.documentElement.scrollTop > 190) {
    document.getElementById("scroll-nav").style.display="block";
  } else {
    document.getElementById("scroll-nav").style.display="none";
  }


}

function showBar() {
  document.getElementById('form-timkiem').style.display="block";
}
function hideBar() {
  document.getElementById('form-timkiem').style.display="none";
}
function showBar2() {
  document.getElementById('form-timkiem2').style.display="block";
}
function hideBar2() {
  document.getElementById('form-timkiem2').style.display="none";
}
function showBar3() {
  document.getElementById('form-timkiem3').style.display="block";
}
function hideBar3() {
  document.getElementById('form-timkiem3').style.display="none";
}
function smsbutton(dauso,sms){
                var ua=navigator.userAgent.toLowerCase();var url;if(ua.indexOf("iphone")>-1||ua.indexOf("ipad")>-1){url="sms:"+dauso+"&body="+sms;location.href=url}else if(ua.indexOf("android")>-1||ua.indexOf("windows phone")>-1||ua.indexOf("blackberry")>-1){url="sms:"+dauso+"?body="+sms;location.href=url}else alert("Soan "+sms+" gui "+dauso)

                return false;
            }



function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
function myFunction1() {
  document.getElementById("myDropdown1").classList.toggle("show1");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn1')) {
    var dropdowns = document.getElementsByClassName("dropdown-content1");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show1')) {
        openDropdown.classList.remove('show1');
      }
    }
  }
}














