import $ from 'jquery'

class AjaxButton {
    constructor( buttonSelector ) {
      const followButtons = document.querySelectorAll( buttonSelector )

      followButtons.forEach(( button ) => {
        new Button( button )
      })
    }
}

class Button {
  constructor ( button ) {
    this.button = button
    this.url = this.href

    this.button.addEventListener( 'click', (e) => {
      e.preventDefault()

      $.ajax({
        url: this.url,
        success: (response) => {

          if ( this.button.classList.contains( 'follow' ) ) {
            this.button.classList.remove( 'follow' )
            this.button.classList.add( 'unfollow' )
            this.button.innerText = 'Désuivre'
          } else {
            this.button.classList.add( 'follow' )
            this.button.classList.remove( 'unfollow' )
            this.button.innerText = 'Suivre'
          }
          console.log(response)

        }
      })
    })
  }
}

export { AjaxButton }
