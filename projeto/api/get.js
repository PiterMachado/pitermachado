window.addEventListener('load', async ()=>{
    let posts = await fetch('http://localhost/projeto/api/post/read.php')
    posts = await posts.json()
    let div = document.querySelector('div.posts')
    for (let i = 0; i < posts.length; i++) {
        let el = document.createElement('div')
        el.dataset.value = posts[i].id_categoria
        el.innerHTML = posts[i].titulo + "<p>" + posts[i].texto + "</p>"
        div.appendChild(el)
    }
})
