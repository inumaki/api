function fetch_guests()
{
	var baseurl="http://localhost/woohoo_training/23.01.2023/myapp/api/";
		jQuery.ajax({
		url:baseurl+"fetch_data.php",
		type:"post",
		data:{},
		success:function(data){
			var guest_data=JSON.parse(data);
			var pre_text=`<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Action</th></tr>`;
			var final_text='';
			var text='';
			for(let i in  guest_data)
			{
				text+=`<tr><td>`+guest_data[i].id+`</td><td>`+guest_data[i].firstname+`</td><td>`+guest_data[i].lastname+`</td><td><button onclick="view_data(`+guest_data[i].id+`);" class="w3-btn w3-blue">View</button>&nbsp;&nbsp;<button onclick="edit_data(`+guest_data[i].id+`);" class="w3-btn w3-green">Edit</button>&nbsp;&nbsp;<button onclick="delete_data(`+guest_data[i].id+`);"class="w3-btn w3-red">Delete</button></td></tr>`;
			}
			final_text=pre_text+text;
			document.getElementById("mytable").innerHTML=final_text;
		},
		error:function(err)
		{
			var msg="Error fetching the gusest details!";
			 Swal.fire({
				icon: 'error',
				title: "Alert!",
				html: "<b>"+msg+"</b>",
				showConfirmButton: true,
				timer: 17000,
			});
		}
    });
}
function view_data(guest_id)
{
	var baseurl="http://localhost/woohoo_training/23.01.2023/myapp/api/";
		jQuery.ajax({
		url:baseurl+"fetch_single_data.php",
		type:"post",
		data:{guest_id:guest_id},
		success:function(data){
			var guest_data=JSON.parse(data);
			var pre_text=`<table class="w3-table-all"><tr><th>ID</th><th>First Name</th><th>Last Name</th></tr>`;
			var post_text=`</table>`;
			var final_text='';
			var text=`<tr><td>`+guest_data.id+`</td><td>`+guest_data.firstname+`</td><td>`+guest_data.lastname+`</td></tr>`;
			final_text=pre_text+text+post_text;
			var msg="Error fetching the gusest details!";
			 Swal.fire({
				icon: 'info',
				title: "Alert!",
				html: "<b>"+final_text+"</b>",
				showConfirmButton: true,
				timer: 17000,
			});
		},
		error:function(err)
		{
			var msg="Error fetching the gusest details!";
			 Swal.fire({
				icon: 'error',
				title: "Alert!",
				html: "<b>"+msg+"</b>",
				showConfirmButton: true,
				timer: 17000,
			});
		}
    });
}
function isEmpty(val)
{
    return (val === undefined || val == null || val.length <= 0) ? true : false;
}
function edit_data(guest_id)
{
	var baseurl="http://localhost/woohoo_training/23.01.2023/myapp/api/";
		jQuery.ajax({
		url:baseurl+"fetch_single_data.php",
		type:"post",
		data:{guest_id:guest_id},
		success:function(data){
			var guest_data=JSON.parse(data);
			var pre_text=`<table class="w3-table-all">`;
			var post_text=`</table>`;
			var final_text='';
			var text=`<tr><th>ID</th><td><input type="number" value="`+guest_data.id+`" readonly="readonly" name="guest_id" id="guest_id"/> </td></tr><tr><th>First Name</th><td><input type="text" value="`+guest_data.firstname+`" name="firstname" id="firstname" /></td></tr><tr><th>Last Name</th><td><input type="text" value="`+guest_data.lastname+`" name="lastname" id="lastname"/></td></tr>`;
			final_text=pre_text+text+post_text;
			var msg="Error fetching the gusest details!";
			 Swal.fire({
				title: "Update Guest Data for ID-"+guest_data.id+" .<br/>Are you sure?",
				html: "<b>"+final_text+"</b>",
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Update Now'
			}).then((result)=>
			   {
					var veeru= JSON.stringify(result);
					var sandy = JSON.parse(veeru);
					if (sandy.value) 
					{
						var guest_id=document.getElementById("guest_id").value;
						var firstname=document.getElementById("firstname").value;
						var lastname=document.getElementById("lastname").value;
						if(isEmpty(guest_id) || isEmpty(firstname) || isEmpty(lastname))
						{
							veermymsg="No data to update.";
							Swal.fire({
								icon: 'error',
								title: "First add data to update!",
								html: "<b>"+veermymsg+"</b>",
								showConfirmButton: true,
								timer: 17000,
							});
						}
						else
						{
							update_guest(guest_id,firstname,lastname);
						}
					}
				})	
			
		},
		error:function(err)
		{
			var msg="Error fetching the gusest details!";
			 Swal.fire({
				icon: 'error',
				title: "Alert!",
				html: "<b>"+msg+"</b>",
				showConfirmButton: true,
				timer: 17000,
			});
		}
    });
}
function update_guest(guest_id,firstname,lastname)
{
	var baseurl="http://localhost/woohoo_training/23.01.2023/myapp/api/";
		jQuery.ajax({
		url:baseurl+"update_data.php?guest_id="+guest_id,
		type:"post",
		data:{firstname:firstname,lastname:lastname},
		success:function(data){
			if(data)
			{
				var msg="Data updated successfully!";
				 Swal.fire({
					icon: 'success',
					title: "Alert!",
					html: "<b>"+msg+"</b>",
					showConfirmButton: true,
					timer: 17000,
				}).then(() => {
                    location.reload();
                });
			}
			else
			{
				var msg="Error updating Data!";
				 Swal.fire({
					icon: 'error',
					title: "Alert!",
					html: "<b>"+msg+"</b>",
					showConfirmButton: true,
					timer: 17000,
				}).then(() => {
                    location.reload();
                })	
			}
		},
		error:function(err)
		{
			var msg="Error fetching the gusest details!";
			 Swal.fire({
				icon: 'error',
				title: "Alert!",
				html: "<b>"+msg+"</b>",
				showConfirmButton: true,
				timer: 17000,
			});
		}
    });	
}
function delete_data(guest_id)
{
	alert("delete data Guest ID:"+guest_id);
}
function add_new_guest()
{
	alert("add new guest");
}