const botaoMobile = document.querySelector('.botao-mobile')


function viewMenu(event) {
   if (event.type === 'touchstart'){
      event.preventDefault()
   }

   const nav = document.querySelector('#menu')
   nav.classList.toggle('active')

   const active = nav.classList.contains('active')

   event.currentTarget.setAttribute('aria-expanded', active)

   if (active) {
      event.currentTarget.setAttribute('aria-label', 'Fechar Menu')
   } else {
      event.currentTarget.setAttribute('aria-label', 'Abrir Menu')
   }
}


botaoMobile.addEventListener('click', viewMenu)
botaoMobile.addEventListener('touchstart', viewMenu)