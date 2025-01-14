@if ($carouselsss->isNotEmpty())
<div class="banner-container" style="position: relative; width: 100%; height: auto; overflow: hidden;">
    <div class="banner" id="autoScrollBanner" style="overflow-x: scroll; white-space: nowrap; height: auto; scrollbar-width: none; -ms-overflow-style: none;">
        @foreach ($carouselsss as $carousels)
            <img class="welcome_area bg-img" 
                 src="{{ asset('images/' . $carousels->image) }}" 
                 alt="Banner Image" 
                 >
        @endforeach
    </div>
    <div id="imageIndicator" 
         style="position: absolute; bottom: 10px; left: 10px; background: rgba(0, 0, 0, 0.5); color: white; padding: 5px 10px; border-radius: 5px; font-size: 14px; z-index: 10;">
        1/{{ $carouselsss->count() }}
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const banner = document.getElementById('autoScrollBanner');
        const images = banner.querySelectorAll('img');
        const imageIndicator = document.getElementById('imageIndicator');
        let currentIndex = 0;
        let autoScrollInterval;
        let userScrolling = false;

        function updateIndicator() {
            imageIndicator.textContent = `${currentIndex + 1}/${images.length}`;
        }

        function scrollToNextImage() {
            if (userScrolling || images.length === 0) return;

            const nextImage = images[currentIndex];
            const nextImageOffset = nextImage.offsetLeft;

            banner.scrollTo({
                left: nextImageOffset,
                behavior: 'smooth'
            });

            currentIndex = (currentIndex + 1) % images.length;
            updateIndicator();
        }

        function startAutoScroll() {
            stopAutoScroll();
            autoScrollInterval = setInterval(scrollToNextImage, 2000);
        }

        function stopAutoScroll() {
            clearInterval(autoScrollInterval);
        }

        banner.addEventListener('scroll', () => {
            userScrolling = true;
            stopAutoScroll();

            const scrollPosition = banner.scrollLeft;
            images.forEach((img, index) => {
                if (img.offsetLeft <= scrollPosition + img.offsetWidth / 2) {
                    currentIndex = index;
                }
            });

            updateIndicator();

            setTimeout(() => {
                userScrolling = false;
                startAutoScroll();
            }, 2000);
        });

        updateIndicator(); 
        startAutoScroll();
    });
</script>
@endif
