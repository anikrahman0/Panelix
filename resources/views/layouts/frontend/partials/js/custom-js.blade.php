   <script>
      $(document).on('click','.wishlist-btn', function (e) {
         console.log('wishlist-btn');
      
         e.preventDefault();
         const button = $(this);
         const bookId = button.data('book-id');

         $.ajax({
            url: '{{ route("wishlist.update") }}',
            type: 'POST',
            data: {
               _token: '{{ csrf_token() }}',
               book_id: bookId
            },
            success: function (response) {
               const icon = button.find('i');
               const wrapper = button.closest('.product-details-wishlist');
               const count =$('.wishlist_count');

               if (response.status === 'added') {
                  icon.removeClass('fa-regular').addClass('fa-solid');
                  wrapper.find('i').removeClass('fa-regular').addClass('fa-solid wishlisted');
                  wrapper.find('.wishlist-text').text('পছন্দের তালিকা থেকে সরান');
                  count.text(response.count);
               } else {
                  icon.removeClass('fa-solid').addClass('fa-regular');
                  wrapper.find('i').removeClass('fa-solid wishlisted').addClass('fa-regular');
                  wrapper.find('.wishlist-text').text('পছন্দের তালিকায় যুক্ত করুন');
                   count.text(response.count);
               }
               showSuccessMessage(response.message);
            }
         });
      });

      $(document).ready(function() {
         var showAlreadyRegisteredModal = "{{Session::has('already_registered')}}";
         if (showAlreadyRegisteredModal) {
            $('#warning-modal').modal('show');
         }
      });
      document.addEventListener('DOMContentLoaded',function(){
         if (window.jQuery && jQuery.fn && jQuery.fn.on) {
            var hasLazy = !!jQuery.fn.Lazy;
            if (!hasLazy) {
               var s=document.createElement('script'); s.src='https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.11/jquery.lazy.min.js';
               s.onload=function(){ jQuery(function(){ jQuery('.lazy').Lazy({effect:'fadeIn',effectTime:300}); }); };
               document.head.appendChild(s);
            } else {
               jQuery(function(){ jQuery('.lazy').Lazy({effect:'fadeIn',effectTime:300}); });
            }
         } else {
               var imgs=document.querySelectorAll('img.lazy');
               if('IntersectionObserver'in window){
                  var io=new IntersectionObserver(function(es,o){es.forEach(function(e){
                     if(e.isIntersecting){var i=e.target; if(i.dataset.src){i.src=i.dataset.src;} i.classList.add('lazy-loaded'); o.unobserve(i);}
                  });});
                  imgs.forEach(function(i){io.observe(i);});
               } else {
                  imgs.forEach(function(i){ if(i.dataset.src){i.src=i.dataset.src;} i.classList.add('lazy-loaded'); });
               }
         }
      });
   </script>