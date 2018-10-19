import { FormMaterial } from './FormMaterial'
import { AjaxFollowButton, AjaxRePostButton, AjaxLikeButton } from './AjaxButton'

document.addEventListener('DOMContentLoaded', () => {
  new FormMaterial('.js_form')
  new AjaxFollowButton( '.follow-button' )
  new AjaxRePostButton( '.repost-button' )
  new AjaxLikeButton( '.like-button' )
})
