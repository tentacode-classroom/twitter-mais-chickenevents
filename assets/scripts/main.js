import { FormMaterial } from './FormMaterial'
import { AjaxButton } from './AjaxButton'

document.addEventListener('DOMContentLoaded', () => {
  new FormMaterial('.js_form')
  new AjaxButton( '.follow-button' )
})
