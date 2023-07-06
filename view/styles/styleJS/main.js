/* ========== SHOW MENU ========== */
const navMenu = document.getElementById( 'nav-menu' ),
      navToggle = document.getElementById( 'nav-toggle' ),
      navClose = document.getElementById( 'nav-close' )


// Menu Show
if ( navToggle ) {
    navToggle.addEventListener( 'click', () => {
        navMenu.classList.add( 'nav__menu-show' )
    })
}

// Menu Hidden
if ( navClose ) {
    navClose.addEventListener( 'click', () => {
        navMenu.classList.remove( 'nav__menu-show' )
    })
}

// Remove Mobile
const navLink = document.querySelectorAll( '.nav__link' )

if ( navLink ) {
    navLink.forEach( n => n.addEventListener( 'click', () => {
        navMenu.classList.remove( 'nav__menu-show' )
    }))
}

/* ========== SHOW PASSWORD ========== */
const togglePassword = document.getElementById( 'toggle-password' )

if ( togglePassword ) {
    togglePassword.addEventListener( 'click', () => {
        const password = document.getElementById( 'password' )
        const type = password.getAttribute( 'type' ) === 'password' ? 'text' : 'password'
        password.setAttribute( 'type', type )
    })
}

/*=============== SCROLL SECTIONS ACTIVE LINK ===============*/

window.addEventListener('scroll', () => {
    const sections = document.querySelectorAll('section[id]')
    const scrollY = window.pageYOffset

    sections.forEach( current => {
        const sectionHeight = current.offsetHeight,
              sectionTop = current.offsetTop - 50,
              sectionId = current.getAttribute('id')

        if(scrollY > sectionTop && scrollY <= sectionTop + sectionHeight)
            document.querySelector('.nav__menu a[href*=' + sectionId + ']').classList.add('active-link')
        else
            document.querySelector('.nav__menu a[href*=' + sectionId + ']').classList.remove('active-link')
        
    })
})


/* ========== HOME SWIPER ========== */
let homeSwiper = new Swiper( '.home-swiper', {
    spaceBetween: 30,
    slidesPerView: 1,
    centeredSlides: true,
    mousewheel: true,
    loop: 'true',
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },
    keyboard: {
        enable: true
    },
    pagination: {
        el: ".swiper-pagination",
        /*dynamicBullets: true,*/
        clickable: true
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
})

/* ========== CHANGE THEME ========== */
const themeBtn = document.getElementById( 'theme-btn' ),
      darkTheme = 'dark-theme',
      iconTheme = 'bxs-sun'

const selectedTheme = localStorage.getItem( 'selected-theme' ),
      selectedIcon = localStorage.getItem( 'selected-icon' )

const getCurrentTheme = () => document.body.classList.contains( darkTheme ) ? 'dark' : 'light',
      getCurrentIcon = () => themeBtn.classList.contains( iconTheme ) ? 'bxs-moon' : 'bxs-sun'

if ( selectedTheme ) {
    document.body.classList[selectedTheme === 'dark' ? 'add' : 'remove'](darkTheme)
    themeBtn.classList[selectedTheme === 'bxs-moon' ? 'add' : 'remove'](iconTheme)
}

themeBtn.addEventListener( 'click', () => {
    document.body.classList.toggle( darkTheme )
    themeBtn.classList.toggle( iconTheme )
    localStorage.setItem( 'selected-theme', getCurrentTheme() )
    localStorage.setItem( 'selected-icon', getCurrentIcon() )
})




/* ========== CHANGE BACKGROUND HEADER ========== */
window.addEventListener( 'scroll', () => {
    const header = document.getElementById( 'header' )
    // Lorsque le scroll est superieur a 50 viewport, on ajout la classe 'scroll-header'
    if ( this.scrollY >= 50 )
        header.classList.add( 'scroll-header' )
    else
        header.classList.remove( 'scroll-header' )
})

/* ========== NEW SWIPER ========== */
let newSwiper = new Swiper( '.new-swiper', {
    spaceBetween: 20,
    centeredSlides: true,
    mousewheel: true,
    slidesPerView: 'auto',
    loop: 'true',
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },
    pagination: {
        clickable: true
    },
    keyboard: {
        enable: true
    },
    navigation : {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
})

/* ========== CARD SWIPER ========== */
let cardSwiper = new Swiper(".card-swiper", {
    centeredSlides: true,
    pagination: {
        el: ".swiper-pagination",
          clickable: true,
          renderBullet: function (index, className) {
            return '<span class="' + className + '">' + (index + 1) + "</span>";
          },
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });



