const giphyApiKey = "WvFILWNYhvmL1AKhKDd5CwAbVl8qxlRH";

const chatWindow = document.getElementById("chatWindow");
const chatText = document.getElementById("chatText");
const searchModal = new bootstrap.Modal(document.getElementById("searchModal"));
const searchInput = document.getElementById("searchInput");
const searchForm = document.getElementById("searchForm");
const searchResults = document.getElementById("searchResults");
const modalTitle = document.getElementById("modalTitle");

let searchType = "";

function sendMessage(text, isHtml = false) {
    if (!text) return;
    const msg = document.createElement("div");
    msg.className = "chat-message";
    msg.innerHTML = isHtml ? text : escapeHtml(text);
    chatWindow.appendChild(msg);
    chatWindow.scrollTop = chatWindow.scrollHeight;
    chatText.value = "";
}

function sendMessageFromInput() {
    const text = chatText.value.trim();
    if (text) sendMessage(text);
}

function escapeHtml(str) {
    return str.replace(/</g, "&lt;").replace(/>/g, "&gt;");
}

function openModal(type) {
    searchType = type;
    modalTitle.textContent = `Buscar ${type === "gif" ? "GIF" : "Emoji"}`;
    searchInput.value = "";
    searchResults.innerHTML = "";
    searchModal.show();
}

searchForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const query = searchInput.value.trim().toLowerCase();
    if (!query) return;

    searchResults.innerHTML = "Cargando...";

    if (searchType === "gif") {
        const res = await fetch(`https://api.giphy.com/v1/gifs/search?api_key=${giphyApiKey}&q=${encodeURIComponent(query)}&limit=12`);
        const data = await res.json();
        searchResults.innerHTML = "";
        data.data.forEach(gif => {
            const img = document.createElement("img");
            img.src = gif.images.fixed_height.url;
            img.onclick = () => {
                sendMessage(`<img src="${gif.images.fixed_height.url}">`, true);
                searchModal.hide();
            };
            searchResults.appendChild(img);
        });
    } else if (searchType === "emoji") {
        const res = await fetch("emojis_es_unicos.json");
        const data = await res.json();
        const resultados = data.filter(e => e.nombre.includes(query));
        searchResults.innerHTML = "";
        resultados.forEach(emoji => {
            const span = document.createElement("span");
            span.textContent = emoji.caracter;
            span.title = emoji.nombre;
            span.style.cursor = "pointer";
            span.onclick = () => {
                sendMessage(emoji.caracter);
                searchModal.hide();
            };
            searchResults.appendChild(span);
        });

        if (resultados.length === 0) {
            searchResults.innerHTML = "<p>No se encontraron emojis.</p>";
        }
    }
});
