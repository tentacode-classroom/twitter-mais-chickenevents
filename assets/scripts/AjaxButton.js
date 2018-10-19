import $ from 'jquery'

class AjaxButton {
  constructor (buttonSelector) {
    const followButtons = document.querySelectorAll(buttonSelector)

    followButtons.forEach((button) => {
      this.newClass(button)
    })
  }

  newClass(button) {
    new Button(button)
  }
}
class Button {
  constructor (button) {
    this.button = button
    this.url = this.button.href

    this.button.addEventListener('click', (e) => {
      e.preventDefault()

      $.ajax({
        url: this.url,
        success: (response) => {
          this.ajaxSuccess(response)
        }
      })
    })
  }

  ajaxSuccess(response) {
    console.log(response)
  }
}

class AjaxFollowButton extends AjaxButton {
  constructor (buttonSelector) {
    super(buttonSelector)
  }

  newClass(button) {
    new FollowButton(button)
  }
}
class FollowButton extends Button {
  constructor (button) {
    super(button)


    let parent = this.button
    while ( !parent.classList.contains( 'user-block' ) ) {
      parent = parent.parentElement
    }
    this.parent = parent

    this.currentUserCounter = document.querySelector( '#js-current-user' ).querySelector( '.js-user-followings-count' )
    this.count = this.parent.querySelector( '.js-user-followers-count' )
  }

  ajaxSuccess(response) {
    if (this.button.classList.contains('follow')) {
      this.button.classList.remove('follow')
      this.button.classList.add('unfollow')
      this.button.innerText = 'Désuivre'
      this.count.innerText = Number(this.count.innerText) + 1
      this.currentUserCounter.innerText = Number(this.currentUserCounter.innerText) + 1
    } else {
      this.button.classList.add('follow')
      this.button.classList.remove('unfollow')
      this.button.innerText = 'Suivre'
      this.count.innerText = Number(this.count.innerText) - 1
      this.currentUserCounter.innerText = Number(this.currentUserCounter.innerText) - 1
    }
  }
}

class AjaxRePostButton extends AjaxButton {
  constructor (buttonSelector) {
    super(buttonSelector)
  }

  newClass(button) {
    new FollowButton(button)
  }
}
class RePostButton extends Button {
  constructor (button) {
    super(button)


    let parent = this.button
    while ( !parent.classList.contains( 'user-block' ) ) {
      parent = parent.parentElement
    }
    this.parent = parent

    this.currentUserCounter = document.querySelector( '#js-current-user' ).querySelector( '.js-user-followings-count' )
    this.count = this.parent.querySelector( '.js-user-followers-count' )
  }

  ajaxSuccess(response) {
    if (this.button.classList.contains('follow')) {
      this.button.classList.remove('follow')
      this.button.classList.add('unfollow')
      this.button.innerText = 'Désuivre'
      this.count.innerText = Number(this.count.innerText) + 1
      this.currentUserCounter.innerText = Number(this.currentUserCounter.innerText) + 1
    } else {
      this.button.classList.add('follow')
      this.button.classList.remove('unfollow')
      this.button.innerText = 'Suivre'
      this.count.innerText = Number(this.count.innerText) - 1
      this.currentUserCounter.innerText = Number(this.currentUserCounter.innerText) - 1
    }
  }
}

export { AjaxFollowButton, AjaxRePostButton }
