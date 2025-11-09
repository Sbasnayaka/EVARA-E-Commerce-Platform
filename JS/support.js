function validateMsg()
{
	var name = document.getElementById("name").value;
	var email = document.getElementById("email").value;
	var message = document.getElementById("message").value;
	
	if ( name ==null || email ==null || message ==null )
		{
			alert("Hellow "+name+".... Pleace carefully fill this out !! ");
		}
		else
		{
			alert("Hellow "+name+".... Your message sent successfuly sooo don't worryy as soon as we will assist you !! ");
		}
}
