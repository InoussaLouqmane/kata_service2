document.addEventListener('DOMContentLoaded', function(){
    const requestTable = new DataTable('#requestTable');
    const clubTable = new DataTable('#clubTable');
    const myFilter = document.getElementById('requestFilter');

    requestTable.search('Pending');
    requestTable.draw();
    console.log(myFilter.value);


    myFilter.addEventListener('change', function(e) {
        console.log("Changement de value : ", this.value);

        if (this.value === "All") {
            requestTable.search('');
        }else{
            myTable.search(this.value);
        }
        requestTable.draw();
    });

})
