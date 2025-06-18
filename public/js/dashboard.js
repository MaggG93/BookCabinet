"use strict";

document.addEventListener("DOMContentLoaded", function () {
  const dropdown = document.getElementById("collectionDropdown");
  const booksContainer = document.getElementById("booksContainer");
  const searchInput = document.getElementById("searchInput");

  let librosCargados = []; // Guardar libros para filtrar

  function cargarLibros(collectionId) {
    booksContainer.innerHTML = "<p>Cargando libros...</p>";

    fetch("/bookcabinet/ajax/get_books.php?collection_id=" + collectionId)
      .then((response) => response.json())
      .then((data) => {
        if (Array.isArray(data)) {
          librosCargados = data; // Guardar en la variable global
          mostrarLibros(librosCargados, collectionId);
        } else {
          booksContainer.innerHTML = `<p>${
            data.error || "No se encontraron libros."
          }</p>`;
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        booksContainer.innerHTML =
          "<p>Hubo un problema al cargar los libros.</p>";
      });
  }

  function mostrarLibros(libros, collectionId) {
    booksContainer.innerHTML = "";

    if (libros.length === 0) {
      booksContainer.innerHTML = "<p>No se encontraron libros.</p>";
      return;
    }

    libros.forEach((libro) => {
      const div = document.createElement("div");
      div.classList.add("book-item");
      div.innerHTML = `
        <a href="book.php?id=${libro.id}&collection_id=${collectionId}" class="book-link">
          <img src="${libro.cover_image}" alt="Portada de ${libro.title}" class="cover-image">
          <p><strong>${libro.title}</strong></p>
          <small>${libro.author}</small>
        </a>
      `;
      booksContainer.appendChild(div);
    });
  }

  // Evento de búsqueda
  if (searchInput) {
    searchInput.addEventListener("input", function () {
      const texto = this.value.toLowerCase();
      const filtrados = librosCargados.filter((libro) => {
        return (
          libro.title.toLowerCase().includes(texto) ||
          libro.author.toLowerCase().includes(texto)
        );
      });

      mostrarLibros(filtrados, dropdown.value);
    });
  }

  // Cargar libros al inicio
  if (dropdown.value) {
    cargarLibros(dropdown.value);
  }

  // Cambiar colección
  dropdown.addEventListener("change", function () {
    searchInput.value = ""; // Limpiar búsqueda al cambiar colección
    cargarLibros(this.value);
  });
});
