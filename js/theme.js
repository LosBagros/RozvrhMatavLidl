
$("table").children().children().children().addClass("border border-info p-3");
$("table").children().children().addClass("border border-info");

// save theme to local storage
const theme = localStorage.getItem('theme')
const btnSwitch = document.createElement('button')
btnSwitch.id = 'btnSwitch'
if (theme) {
    document.documentElement.setAttribute('data-bs-theme', theme)
    if (theme == 'dark') {
        btnSwitch.className = 'btn btn-light m-3 float-end'
        btnSwitch.innerHTML = '☀'
    } else {
        btnSwitch.className = 'btn btn-dark m-3 float-end'
        btnSwitch.innerHTML = '☾'
    }
    document.body.appendChild(btnSwitch)
} else {
    document.documentElement.setAttribute('data-bs-theme', 'light')
    btnSwitch.className = 'btn btn-dark m-3 float-end'
    btnSwitch.innerHTML = '☀'
    document.body.appendChild(btnSwitch)
    localStorage.setItem('theme', 'dark')
}

document.getElementById('btnSwitch').addEventListener('click',()=>{
    if (document.documentElement.getAttribute('data-bs-theme') == 'dark') {
        document.documentElement.setAttribute('data-bs-theme','light')
        btnSwitch.className = 'btn btn-dark m-3 float-end'
        btnSwitch.innerHTML = '☾'
        localStorage.setItem('theme', 'light')
    }
    else {
        document.documentElement.setAttribute('data-bs-theme','dark')
        btnSwitch.className = 'btn btn-light m-3 float-end'
        btnSwitch.innerHTML = '☀'
        localStorage.setItem('theme', 'dark')
    }
})
