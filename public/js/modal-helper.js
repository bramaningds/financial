document.body.insertAdjacentHTML('beforeend', `
    <div class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Save changes</button>
                </div>
            </div>
        </div>
    </div>
`)

function confirmDelete(message, title) {

}

<div class="modal fade" id="modal-html" tabindex="-1">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-body"></div>
    </div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modalHTMLElement = document.querySelector('#modal-html')
    const modalHTML = new bootstrap.Modal(modalHTMLElement)

    document.querySelectorAll('[data-bs-toggle="modal-html"]').forEach(function(element) {
        element.addEventListener('click', function(e) {
            e.preventDefault();

            const link = e.target.href || e.target.getAttribute('data-bs-target')

            modalHTML.show()

            fetch(link, {headers: {Fragment: 'true'}}).then(res => res.text()).then(html => {
                modalHTMLElement.querySelector('.modal-body').innerHTML = html
            })
        })
    })
})
</script>
