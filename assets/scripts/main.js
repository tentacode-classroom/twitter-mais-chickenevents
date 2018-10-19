import { FormMaterial } from './FormMaterial'
import { AjaxFollowButton, AjaxRePostButton, AjaxActionButton } from './AjaxButton'

document.addEventListener('DOMContentLoaded', () => {
  new FormMaterial('.js_form')
  new AjaxFollowButton( '.follow-button' )
  new AjaxRePostButton( '.repost-button' )
  new AjaxActionButton( '.link-button' )
})
