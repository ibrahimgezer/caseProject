$(function () {
    $('#dataTable').DataTable({
        "ordering": true,
        "order":  [[1, "asc"]],
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});

function showPreview(event){
    if(event.target.files.length > 0){
        const src = URL.createObjectURL(event.target.files[0]);
        const preview = document.getElementById("file-preview");
        preview.src = src;
        preview.style.display = "block";
    }
}

function submitButtonClick(event) {
    event.preventDefault();
}