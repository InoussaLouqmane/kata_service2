$(document).ready(function() {


    const requestTable = $('#requestTable').DataTable({
        bDestroy: true,
        dom: 'ltip',
    });


    const myFilter = $('#requestFilter');


    requestTable.search("Pending").draw();

    console.log(myFilter.val());


    myFilter.on('change', function(e) {
        console.log("Changement de value : ", this.value);

        if (this.value === "All") {
            requestTable.search('').draw();
        } else {
            requestTable.search(this.value).draw();
        }

        console.log(myFilter.val());
    });

});
