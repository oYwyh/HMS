let profile = document.getElementById('header-profile');
let profile_options = document.getElementById('profile-options')

profile.onclick = () => {
    profile_options.classList.toggle('none');
}

// Nav
let header_toggle = document.getElementById('header-toggle');
let logo_title = document.getElementById('logo-title')
let nav_links = document.querySelectorAll('#nav-links')
let nav_title = document.getElementById('nav-title')
let logo = document.getElementById('logo')
let links = document.getElementById('links')


header_toggle.onclick = (e) => {
    logo_title.classList.toggle('none')
    nav_title.classList.toggle('none')
    logo.classList.toggle('smaller')
    links.classList.toggle('smaller')
    for(let i = 0; i< nav_links.length; i++) {
        nav_links[i].classList.toggle('none')
    }
}

window.onload = () => {
        if (window.innerWidth <= 1144){
        links.classList.add('smaller');
        logo_title.classList.add('none')
        logo.classList.add('smaller')
        nav_title.classList.add('none')
        for(let i = 0; i< nav_links.length; i++) {
            nav_links[i].classList.add('none')
        }
        }
        else {
        links.classList.remove('smaller');
        logo_title.classList.remove('none')
        logo.classList.remove('smaller')
        nav_title.classList.remove('none')
        for(let i = 0; i< nav_links.length; i++) {
            nav_links[i].classList.remove('none')
        }
}
}
window.onresize = function() {
    if (window.innerWidth <= 1144){
    links.classList.add('smaller');
    logo_title.classList.add('none')
    logo.classList.add('smaller')
    nav_title.classList.add('none')
    for(let i = 0; i< nav_links.length; i++) {
        nav_links[i].classList.add('none')
    }
    }
    else {
    links.classList.remove('smaller');
    logo_title.classList.remove('none')
    logo.classList.remove('smaller')
    nav_title.classList.remove('none')
    for(let i = 0; i< nav_links.length; i++) {
        nav_links[i].classList.remove('none')
    }
    }
};


// input