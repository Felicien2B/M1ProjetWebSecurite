function hideform()
{
    var myForm = document.getElementsByClassName("add-profile-pic");
    var myButton = document.getElementById("toggle");
    if(myForm[0].style.display === "none")
    {
        myForm[0].style.display = "block";
        myButton.innerHTML = "Hide";
        
    } else {
        myForm[0].style.display = "none";
        myButton.innerHTML = "Add profile picture";
    }
}
function hideform2()
{
    var myForm = document.getElementsByClassName("modify-profile-pic");
    var myButton = document.getElementById("toggle2");

    if(myForm[0].style.display === "none")
    {
        myForm[0].style.display = "block";
        myButton.innerHTML = "Hide";
    }
    else
    {
        myForm[0].style.display = "none";
        myButton.innerHTML = "Modify profile picture";
    }
}