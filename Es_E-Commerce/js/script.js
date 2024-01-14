$(document).ready(function(){
    // Esempio di dati dinamici per il carosello
    var productsData = [
        { image: 'iPhone_15_Pro_Max.png', alt: 'Prodotto 1'},
        { image: 'PS5.jpg', alt: 'Prodotto 2'},
        { image: 'Fanatec.png', alt: 'Prodotto 3'},
        // Aggiungi altri oggetti dati per più prodotti
    ];

    // Costruisci il markup del carosello dinamico
    var carouselMarkup = '';
    productsData.forEach(function(product) {
    carouselMarkup += '<div><img src="' + product.image + '" alt="' + product.alt + '" style="width:300px;height:184px;"></div>';
    });

 $('.product-carousel').html(carouselMarkup);

    $('.product-carousel').slick({
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        cssEase: 'ease-in-out',  // Aggiungi questa opzione per specificare l'effetto di transizione
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});