
  	var myForm=document.myForm
  	var startdate=myForm.datepicker1.value
  	var enddate=myForm.datepicker2.value
    function submitdata(e)
    {
       	var startdate=myForm.datepicker1.value
  	    var enddate=myForm.datepicker2.value
  	    if(e.target.tagName=='A')
  	    {
  	    var anchor=e.target
  	    }
  	    else
  	    {
  		  var anchor=e.target.parentNode
       	}
  		  anchor.href+='&startdate='+startdate+'&enddate='+enddate
    }
  	var car =document.getElementById('car')
  	var moto=document.getElementById('moto')
  	var bicycle=document.getElementById('bicycle')
  	var vehicles=document.getElementById('vehicles')
  	var licence=document.getElementById('licence')
  	var immatri=document.getElementById('immatri')
  	var insurence=document.getElementById('insurence')
  	var documents=document.getElementById('documents')
    var accident=document.getElementById('accident')
  	car.addEventListener('click',submitdata)
  	moto.addEventListener('click',submitdata)
  	bicycle.addEventListener('click',submitdata)
  	vehicles.addEventListener('click',submitdata)
  	licence.addEventListener('click',submitdata)
  	immatri.addEventListener('click',submitdata)
  	insurence.addEventListener('click',submitdata)
    documents.addEventListener('click',submitdata)
  	accident.addEventListener('click',function(e)
    {
      var startdate=myForm.datepicker1.value
      var enddate=myForm.datepicker2.value
      var anchor=e.target
      anchor.href+='startdate='+startdate+'&enddate='+enddate
    })
    