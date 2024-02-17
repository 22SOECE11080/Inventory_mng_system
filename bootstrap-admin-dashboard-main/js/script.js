const sidebarToggle = document.querySelector("#sidebar-toggle");
sidebarToggle.addEventListener("click",function(){
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

document.querySelector(".theme-toggle").addEventListener("click",() => {
    toggleLocalStorage();
    toggleRootClass();
});

function toggleRootClass(){
    const current = document.documentElement.getAttribute('data-bs-theme');
    const inverted = current == 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-bs-theme',inverted);
}

function toggleLocalStorage(){
    if(isLight()){
        localStorage.removeItem("light");
    }else{
        localStorage.setItem("light","set");
    }
}

function isLight(){
    return localStorage.getItem("light");
}

if(isLight()){
    toggleRootClass();
}

function print () {
    var printDiv = document.getElementById("divPrint");
    var printWindow = window.open('', '', 'left=0, top=0, width=800, height=500, toolbar=0, scrollbars=0, status=0');
    printWindow.document.write(printDiv.innerHTML);
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
   }