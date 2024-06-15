 
document.addEventListener('DOMContentLoaded', function() {
	var editButtons = document.querySelectorAll('.edit');
	editButtons.forEach(function(button) {
		button.addEventListener('click', function() {
			var id = button.getAttribute('data-id');
			var form = document.getElementById('editEmployeeForm');
			form.action = '/ses/' + id; // Assuming your route is /employee/{id} for updating

			document.getElementById('edit_id').value = id;

			// Optionally, populate other fields based on the clicked row
			var row = button.closest('tr');
			document.getElementById('edit_full_name').value = row.cells[1].innerText;
			document.getElementById('edit_last_name').value = row.cells[2].innerText;
			document.getElementById('edit_age').value = row.cells[3].innerText;
			document.getElementById('edit_sex').value = row.cells[4].innerText;
			document.getElementById('edit_email').value = row.cells[5].innerText;
			document.getElementById('edit_dep').value = row.cells[6].innerText;
			document.getElementById('edit_semister').value = row.cells[7].innerText;
			document.getElementById('edit_status').value = row.cells[8].innerText;
		});
	});
});
document.addEventListener('DOMContentLoaded', function() {
	var deleteButtons = document.querySelectorAll('.delete');
	deleteButtons.forEach(function(button) {
		button.addEventListener('click', function() {
			var id = button.getAttribute('data-id');
			var form = document.getElementById('deleteEmployeeForm');
			form.action = '/ses/' + id; // This sets the form action URL to /ses/{id}
			// Set the ID in the confirmation message
			document.getElementById('delete-employee-id').innerText = id;
		});
	});
});
