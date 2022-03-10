<script>
function validate() {
    var $valid = true;
    document.getElementById("user_info").innerHTML = "";
    document.getElementById("password_info").innerHTML = "";
    
    var userName = document.getElementById("usernameId").value;
    var password = document.getElementById("passwordId").value;
    if(userName == "") 
    {
        document.getElementById("user_info").innerHTML = "required";
        $valid = false;
    }
    if(password == "") 
    {
        document.getElementById("password_info").innerHTML = "required";
        $valid = false;
    }
    return $valid;
}
</script>