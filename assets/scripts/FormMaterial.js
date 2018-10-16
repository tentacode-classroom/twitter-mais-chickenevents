class FormMaterial {

    constructor(selector) {
        this.class = selector.replace('.', '') + '--active'


        const forms = document.querySelectorAll(selector)

        if (!forms) {
            return
        }

        forms.forEach((form) => {
            this.actionOnForm(form)
        })
    }

    actionOnForm = (form) => {
        form.classList.add(this.class)
        form.querySelectorAll('input:not([type="hidden"]):not([type="submit"]), textarea').forEach((input) => {
            new InputMaterial(input)
        })
    }

}

class InputMaterial {

    constructor(item) {
        this.inputClass = 'form-group'
        this.inputClassDefined = this.inputClass + '--defined'
        const input = item

        if (!input) {
            return
        }

        this.parent = input
        while (!this.parent.classList.contains(this.inputClass) && !this.parent.classList.contains('js-form')) {
            this.parent = this.parent.parentNode


            if (this.parent.classList.contains('js-form')) {
                return
            }
        }

        this.checkValue(input)
        input.addEventListener('input', () => {
            this.checkValue(input)
        })
    }

    checkValue = (input) => {
        const value = input.value

        if (value === '') {
            this.undefineParent()
        }

        if (value !== '') {
            this.defineParent()
        }
    }

    defineParent = () => {
        this.parent.classList.add(this.inputClassDefined)
    }

    undefineParent = () => {
        this.parent.classList.remove(this.inputClassDefined)
    }
}

export { FormMaterial }
