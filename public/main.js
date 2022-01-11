function seeClients() 
{
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {  
	    if (xhr.readyState === 4) {	  
			if (xhr.status === 200) {
				let response = xhr.responseText;	
				showClients(JSON.parse(response));
            } else {
                console.log("Something is wrong");
            }			
		} 	
	};

	xhr.open('POST', "../main.php"); 
	xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	xhr.send();	
}

function showClients(data) 
{
	let clientsDiv = document.getElementById("clientsDiv");
	clientsDiv.setAttribute("class", "column");

	for (let i = 0; i <= data.length - 1; i++) {
		let div = document.createElement("div");
		div.setAttribute("class", "row");
		
		let name = document.createElement("p");
		name.innerHTML = data[i].name;
		let surname = document.createElement("p", data[i].surname);
		surname.innerHTML = data[i].surname;
		let phone = document.createElement("p", data[i].phone);
		phone.innerHTML = data[i].phone;
		let commentary = document.createElement("p", data[i].commentary);
		commentary.innerHTML = data[i].commentary;
		
		div.appendChild(name);
		div.appendChild(surname);
		div.appendChild(phone);
		div.appendChild(commentary);
		
		clientsDiv.appendChild(div);
	}
}