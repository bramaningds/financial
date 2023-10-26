function handleErrors(errors, old) {
    const modalName = old['_modal']
    if (!modalName) return;

    const modalElm = document.querySelector(`#${modalName}`)
    if (!modalElm) return;

    // Set the value
    for (field in old) {
        const formElement = document.querySelector(`#${modalName} [name=${field}]`)
        if (!formElement) continue;

        formElement[formElement.tagName == 'TEXTAREA' ? 'innerHTML' : 'value'] = old[field]
        formElement.classList.add(errors[field] ? 'is-invalid' : 'is-valid')

        if (!errors[field]) continue;

        const feedbackElement = document.querySelector(`#${modalName} .invalid-feedback[for=${field}]`)
        if (!feedbackElement) continue;

        feedbackElement.innerHTML = errors[field].join('<br>')
    }

    for (field in errors) {
        const feedbackElement = document.querySelector(`#${modalName} .invalid-feedback[for=${field}]`)
        if (feedbackElement) continue;

        document.querySelector(`#${modalName} .modal-body`).insertAdjacentHTML('afterbegin', alertHTML(field, errors[field]));
    }

    const bsModal = new bootstrap.Modal(modalElm)
    bsModal.show()
}

function alertHTML(title, messages) {
    return `<div class="alert alert-danger" role="alert">
                <div class="mb-2">
                    <strong>
                        <i class="bi bi-exclamation-circle-fill"></i> ${title}
                    </strong>
                </div>

                ${messages.map(message => `<div>${message}</div>`).join('')}
            </div>`
}