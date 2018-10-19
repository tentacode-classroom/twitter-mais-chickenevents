import { FormMaterial } from './FormMaterial'
import { AjaxFollowButton, AjaxRePostButton } from './AjaxButton'

document.addEventListener('DOMContentLoaded', () => {
  new FormMaterial('.js_form')
  new AjaxFollowButton( '.follow-button' )
  new AjaxRePostButton( '.repost-button' )
})
