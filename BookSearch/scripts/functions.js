function myFunction() {
			var s = document.getElementById("mySelect");
			var the_option = s.options[s.selectedIndex].value;//edw exw to value="via_title" Þ  value="via_keyword"
			if (the_option = "via_title"){
			    document.getElementById("demo").innerHTML ="searcing via title selected ";
				//kalw synarthsh gia title
			}else if(the_option ="via_keyword"){
				document.getElementById("demo").innerHTML ="searcing via keyword selected ";//?????????????????????????????den to vgazei!!!
				//kalw synarthsh gia keyword	
			}
			else{
				document.getElementById("demo").innerHTML ="MISTAKE!!!!!!!!!!!!!!!!";//mhnyma la8ous
			}	
		}
		
 function clear_data() {
	
   var textArea = document.getElementById("xml_response");	
   textArea.style.display = 'none'; 
	 
 }



function show_input_fields()
{
  var main_selection = document.getElementById("mySelection");
  var input_1 = document.getElementById("book_title");
  var select_2 = document.getElementById("book_titles");
  var textArea = document.getElementById("xml_response");
  var desired_box = main_selection.options[main_selection.selectedIndex].value;
  
  if(desired_box == "via_title") {
	textArea.style.display = 'none';
    input_1.style.display = 'none';
	var request = new XMLHttpRequest();
         request.open('POST', 'http://127.0.0.1/BookSearch/PHPscripts/getBooksTitles.php', true);
		 request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		 request.onload = function () {
    
          // window.alert(this.responseText);
		   var responsestring = request.responseText;
		   var stringArray = responsestring.split(",");
		   if (select_2.options.length != 0) { //katharizo to dropdown box apo proigoumenes idies times!!
			   var i;
               for(i = select_2.options.length-1;i >= 0; i--)
                 {
                   select_2.remove(i);
                 }
		      }
		   for(i = 0;i < stringArray.length; i++) {
			   var option = document.createElement("option");
               option.value= stringArray[i];
			   option.text = stringArray[i];
			   select_2.add(option);
		   }
         };
         request.send('');
		 
         if (request.status === 200) { //an to http protocol epestrepse kwdiko 200 diladi i istoselida tou script apantise  
          
         }
	
	
    select_2.style.display = '';
  }

  if (desired_box == "prompt") {
     
	input_1.style.display = 'none';
    select_2.style.display = 'none';
	textArea.style.display = 'none';
  }  

  if (desired_box == "via_keyword")  {
    select_2.style.display = 'none';
    input_1.style.display = '';
	textArea.style.display = 'none';
  }
}

function call_server_resource() {
	
   var main_selection = document.getElementById("mySelection");
   var desired_box = main_selection.options[main_selection.selectedIndex].value;
   var textArea = document.getElementById("xml_response");

   if (desired_box == "prompt") {
     window.alert("You must first choose a book search method from the drop down menu!");
   } else {

      if (desired_box == "via_title") {
		  
		  var booktitlelist = document.getElementById("book_titles");
		  
		  var selectedtitle = booktitlelist.options[booktitlelist.selectedIndex].value;
		  
		 var request = new XMLHttpRequest();
          .open('POST', 'http://127.0.0.1/BookSearch/PHPscripts/getBooksByTitle.php', true);
		 request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		 request.onload = function () {
           textArea.value = '';
           //window.alert(this.responseText);
		   textArea.value = this.responseText;
           textArea.style.display = '';		   
           		   
         };
         request.send('title='+selectedtitle);
		 
		

         if (request.status === 200) {
          //window.alert(request.responseText);
         }
		 
	  } else if (desired_box == "via_keyword") {
		  
		 var booktitle = document.getElementById("book_title");
		 
		 if (booktitle.value == "") {
			 window.alert("You must provide a keyword for search in the text input field!");
		 } else {
			
			
	      //window.alert(booktitle.value);  
		 
		 
		 var request = new XMLHttpRequest();
         request.open('POST', 'http://127.0.0.1/BookSearch/PHPscripts/getBooksByKeyword.php', true);
		 request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		 request.onload = function () {
    
          // window.alert(this.responseText);
		   textArea.value = '';
           //window.alert(this.responseText);
		   textArea.value = this.responseText;
           textArea.style.display = '';	
         };
         request.send('keyword='+booktitle.value);
		 
		

         if (request.status === 200) {
          window.alert(request.responseText);
         }
		 
		 
	     }
		  
	  }


   }   
	
   

}
		