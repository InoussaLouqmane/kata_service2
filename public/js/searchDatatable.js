document.addEventListener('DOMContentLoaded', function(){
    const myTable = new DataTable('#requestTable');
    const myFilter = document.getElementById('requestFilter');

    myTable.search('Pending');
    myTable.draw();
    console.log(myFilter.value);


    myFilter.addEventListener('change', function(e) {
        console.log("Changement de value : ", this.value);

        if (this.value === "All") {
            myTable.search('');
        }else{
            myTable.search(this.value);
        }
        myTable.draw();
    });

})
