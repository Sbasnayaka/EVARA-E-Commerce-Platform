function validateUsername() 
		{
            var Uname = document.getElementById("username").value;
            
            if ((Uname == " ") || (Uname == "null")) {
                alert("Please enter full name");
                return false;
            }
            return true;
        }

//-----------------------------------------------------------------------------------------------------------------------------------
function validateEmail() 
		{
            var Uemail = document.getElementById("email").value;
            var at     = Uemail.indexOf("@");
            var dot    = Uemail.lastIndexOf(".");
            var len    = Uemail.length;

            if ((at < 2) || (dot - at < 2) || (len - dot < 2)) 
			{
                alert("Please Enter a valid Email Address");
                return false;
            }
            return true;
        }

//-----------------------------------------------------------------------------------------------------------------------------------
function validatePassword()
		{
            var Upassword = document.getElementById("password").value;
            var Cpassword = document.getElementById("Cpassword").value;

            if ((Upassword.length < 8) || (Upassword != Cpassword)) 
			{
                alert("Please enter the correct password");
                return false;
            }
            return true;
        }
//-----------------------------------------------------------------------------------------------------------------------------------
function handleCreateAcc()
		{
     
            if (validateUsername() && validateEmail() && validatePassword() ) 
			{
                window.location.href = "index.php";
            }
        }
//-----------------------------------------------------------------------------------------------------------------------------------
function navigateToLogin() 
		{
            window.location.href = "login.php";
        }