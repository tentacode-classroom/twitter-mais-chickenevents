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
      this.ajax()
    })
  }

  ajax() {
    $.ajax({
      url: this.url,
      success: (response) => {
        this.ajaxSuccess(response)
      }
    })
  }

  ajaxSuccess(response) {
    console.log(response)
  }
}

class AjaxActionButton extends AjaxButton{
  constructor (buttonSelector) {
    super(buttonSelector)
  }

  newClass(button) {
    new ActionButton(button)
  }
}
class ActionButton extends Button{
  constructor (button) {
    super(button)
  }

  ajax() {
    this.url = this.button.href + '?action=' + this.button.getAttribute( 'action' )
    super.ajax()
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
class FollowButton extends ActionButton {
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
    console.log( this.currentUserCounter)
    console.log( this.count)
    if (this.button.getAttribute( 'action' ) === 'follow') {
      this.button.setAttribute( 'action', 'unfollow')
      this.button.innerText = 'Désuivre'
      this.count.innerText = Number(this.count.innerText) + 1
      this.currentUserCounter.innerText = Number(this.currentUserCounter.innerText) + 1
    } else {
      this.button.setAttribute( 'action', 'follow')
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
    new RePostButton(button)
  }
}
class RePostButton extends ActionButton {
  constructor (button) {
    super(button)

    this.currentUserCounter = document.querySelector( '#js-current-user' ).querySelector( '.js-user-posts-count' )
  }

  ajaxSuccess(response) {
    if (this.button.getAttribute( 'action' ) === 'repost' ) {
      this.button.setAttribute( 'action', 'stop-repost' )
      this.currentUserCounter.innerText = Number(this.currentUserCounter.innerText) + 1
    } else {
      this.button.setAttribute( 'action', 'repost' )
      this.currentUserCounter.innerText = Number(this.currentUserCounter.innerText) - 1
    }
  }
}

class AjaxLikeButton extends AjaxButton{
  constructor (buttonSelector) {
    super(buttonSelector)
  }

  newClass(button) {
    new LikeButton(button)
  }
}
class LikeButton extends ActionButton{
  constructor (button) {
    super(button)
  }

  ajaxSuccess(response) {
    if (this.button.getAttribute( 'action' ) === 'like' ) {
      this.button.setAttribute( 'action', 'unlike' )
    } else {
      this.button.setAttribute( 'action', 'like' )
    }
  }
}

export { AjaxFollowButton, AjaxRePostButton, AjaxLikeButton }
