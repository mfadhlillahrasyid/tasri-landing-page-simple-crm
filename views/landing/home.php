<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Taman Asoka Asri - Rumah Bebas Desain di Medan</title>
    <link rel="icon" href="/assets/images/logo.webp" type="image/x-icon">
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://connect.facebook.net" crossorigin>
    <link rel="preload" as="image" href="<?= e(url('/assets/images/heroBanner.webp')) ?>" fetchpriority="high">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= e(url('/assets/css/app.css')) ?>?v=accordion-1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
    <!-- Meta Pixel Code -->
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return; n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
            n.queue = []; t = b.createElement(e); t.async = !0;
            t.src = v; s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '4297354490585334');
        fbq('track', 'PageView');
        fbq('track', 'ViewContent');
    </script>
    <!-- End Meta Pixel Code -->
</head>

<body class="bg-slate-200 text-slate-900 font-google">
    <noscript>
        <img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=4297354490585334&ev=PageView&noscript=1" alt="">
    </noscript>
    <main class="max-w-md mx-auto bg-white min-h-screen overflow-hidden">
        <div id="hero">
            <img src="<?= e(url('/assets/images/heroBanner.webp')) ?>"
                alt="Rumah bebas desain Taman Asoka Asri di Medan" width="1080" height="1716" fetchpriority="high"
                decoding="async" class="relative z-10 w-full h-auto object-cover">
        </div>

        <!-- Agitation -->
        <section id="agitation" class="relative z-10 p-8 flex flex-col gap-8 -mt-12">
            <div class="flex flex-col gap-4">
                <h1 class="text-2xl font-medium tracking-tight leading-snug ">
                    <span class="bg-blue-700 px-2 rounded-sm text-white text-2xl">Mau Punya Rumah Impian</span> Tapi
                    Desainnya Jangan yang Itu-Itu aja dong...
                </h1>

                <p class="text-sm sm:text-base text-sm sm:text-base leading-relaxed text-slate-600">
                    Banyak orang ingin punya rumah yang sesuai selera dan kebutuhan keluarga. Tapi saat mencari di
                    perumahan, pilihan <mark class="font-semibold">desainnya sering sudah ditentukan dari awal</mark>.
                </p>

            </div>

            <div class="flex flex-col gap-4">
                <ul class="space-y-4">
                    <li
                        class="bg-white border border-neutral-200 p-4 rounded-xl leading-relaxed flex items-center gap-3 text-sm text-slate-600 hover:scale-105 hover:shadow-xl active:scale-105 active:shadow-xl transition-all duration-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-10 text-red-500 shrink-0 inset-0">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Mau ruang keluarga lebih luas, tapi layout-nya sudah terkunci.
                    </li>
                    <li
                        class="bg-white border border-neutral-200 p-4 rounded-xl leading-relaxed flex items-center gap-3 text-sm text-slate-600 hover:scale-105 hover:shadow-xl active:scale-105 active:shadow-xl transition-all duration-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-10 text-red-500 shrink-0 inset-0">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Mau dapur lebih lega, tapi posisinya tidak sesuai.
                    </li>
                    <li
                        class="bg-white border border-neutral-200 p-4 rounded-xl leading-relaxed flex items-center gap-3 text-sm text-slate-600 hover:scale-105 hover:shadow-xl active:scale-105 active:shadow-xl transition-all duration-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-10 text-red-500 shrink-0 inset-0">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Mau ruang tambahan, tapi desain tidak mendukung.
                    </li>
                </ul>
            </div>

            <div class="flex flex-col gap-4">

                <p class="text-sm sm:text-base text-sm sm:text-base leading-relaxed text-slate-600">
                    Lama-lama rumah yang awalnya kamu anggap rumah impian, malah terasa seperti rumah yang <strong>“ya
                        udah lah,
                        yang penting punya”</strong>
                </p>

                <p class="text-sm sm:text-base text-sm sm:text-base leading-relaxed text-slate-600">
                    Bisa ditempati, tapi belum tentu benar-benar nyaman buat keluarga.
                </p>

                <p class="text-sm sm:text-base text-sm sm:text-base leading-relaxed text-slate-600">
                    Akhirnya, kita yang harus menyesuaikan diri dengan rumahnya. Padahal harusnya rumah yang
                    menyesuaikan cara hidup kita 😭😭
                </p>
            </div>
        </section>

        <!-- About -->
        <section id="about" class="flex flex-col gap-8">
            <div class="flex flex-col gap-2">
                <div class="relative">
                    <div
                        class="p-8 absolute top-0 left-0 w-full h-full flex flex-col gap-0 justify-start items-start z-10">
                        <img src="<?= e(url('/assets/images/logo.webp')) ?>" alt="Logo Taman Asoka Asri" width="1031"
                            height="788" loading="lazy" decoding="async" class="size-12">
                        <p class="text-sm font-medium tracking-tight text-blue-700 mt-3">Perkenalkan...</p>
                        <h2 class="text-3xl font-medium tracking-tighter leading-snug">Taman Asoka Asri</h2>
                    </div>
                    <img src="<?= e(url('/assets/images/aboutBanner.webp')) ?>" alt="Kawasan perumahan Taman Asoka Asri"
                        width="1080" height="921" loading="lazy" decoding="async" class="w-full h-auto object-cover">
                </div>
                <p class="text-sm sm:text-base leading-relaxed text-slate-600 px-8">Taman Asoka Asri adalah perumahan
                    yang memberikan
                    kebebasan desain <strong>Pertama di Kota Medan!</strong></p>

                <p class="text-sm sm:text-base leading-relaxed text-slate-600 px-8">Dengan konsep rumah bebas desain,
                    kamu bisa menyesuaikan
                    rumah dengan
                    kebutuhan dan
                    selera keluarga <mark class="font-medium">tanpa harus terikat dengan desain yang sudah
                        ditentukan</mark> sebelumnya.</p>
            </div>
        </section>

        <!-- Gallery -->
        <section id="gallery" class="flex flex-col gap-4 pt-8"
            data-gallery-base="<?= e(url('/assets/images/harvest')) ?>">
            <div class="px-8">
                <p class="text-sm font-semibold text-blue-700">Inspirasi Bebas Desain</p>
                <h2 class="mt-2 text-xl font-medium tracking-tight leading-snug max-w-xs">
                    Mulai bayangkan rumah yang benar-benar sesuai dengan gaya hidupmu.
                </h2>
            </div>

            <div class="flex flex-col gap-4" data-gallery-wrapper></div>

            <div class="p-8 flex justify-center items-center">
                <?php component('button', ['as' => 'a', 'href' => url('#lead-form'), 'label' => 'Ambil Brosur Sekarang', 'class' => 'bg-blue-800 px-6 py-1 text-slate-100 hover:scale-105 active:scale-100']); ?>
            </div>
        </section>

        <!-- why us -->
        <section id="why-us" class="flex flex-col gap-8 p-8">
            <div class="flex flex-col gap-2">

                <h2 class="text-xl font-medium tracking-tight leading-snug">Bebas Desain Gimana Maksudnya ?</h2>

                <p class="text-sm sm:text-base leading-relaxed text-slate-600">Di Taman Asoka Asri, kamu gak harus
                    mengikuti desain rumah
                    yang sudah ditentukan dari awal, layaknya perumahan pada umumnya...</p>

                <div class="flex flex-wrap gap-2 py-2">
                    <span
                        class="bg-blue-100 border border-blue-200 text-blue-900 px-2 py-1 rounded-md text-sm font-medium">Kalau
                        bebas desain, nanti malah ribet gak?</span>
                    <span
                        class="bg-blue-100 border border-blue-200 text-blue-900 px-2 py-1 rounded-md text-sm font-medium">Takutnya
                        banyak request jadi bingung.</span>
                    <span
                        class="bg-blue-100 border border-blue-200 text-blue-900 px-2 py-1 rounded-md text-sm font-medium">Aman
                        gak ya kira-kira?</span>
                    <span
                        class="bg-blue-100 border border-blue-200 text-blue-900 px-2 py-1 rounded-md text-sm font-medium">Entar
                        jelek hasilnya!</span>
                </div>

                <h2 class="text-xl font-medium tracking-tight leading-snug">Tenang...</h2>

                <p class="text-sm sm:text-base leading-relaxed text-slate-600">Kami bantu kamu merencanakan rumah yang
                    lebih sesuai dengan
                    kebutuhan keluarga, gaya hidup, dan rencana masa depan.</p>
            </div>

        </section>

        <section id="why-tasri" class="flex flex-col gap-8 bg-[#050d57]">
            <div class="flex flex-col gap-4 p-8">
                <h2 class="text-xl font-medium tracking-tight leading-snug text-white">Kenapa Harus TASRI, <br />Bukan
                    Perumahan Lain
                    ?</h2>

                <div class="flex flex-col gap-4">
                    <ul class="space-y-4">
                        <li
                            class="bg-white border border-neutral-200 p-4 rounded-xl leading-relaxed flex items-center gap-3 text-sm text-slate-600 hover:scale-105 hover:shadow-xl active:scale-105 active:shadow-xl transition-all duration-500">
                            <img src="<?= e(url('/assets/images/benefits/free_design.png')) ?>"
                                alt="Ikon bebas desain rumah" width="512" height="512" loading="lazy" decoding="async"
                                class="w-10">
                            <div>
                                <h3 class="font-semibold text-slate-800 text-base">Bebas Desain Rumah</h3>
                                <p>Rumah bisa kamu sesuaikan dengan kebutuhan keluarga.</p>
                            </div>
                        </li>
                        <li
                            class="bg-white border border-neutral-200 p-4 rounded-xl leading-relaxed flex items-center gap-3 text-sm text-slate-600 hover:scale-105 hover:shadow-xl active:scale-105 active:shadow-xl transition-all duration-500">
                            <img src="<?= e(url('/assets/images/benefits/free_jasa_arsitek.png')) ?>"
                                alt="Ikon free jasa arsitek" width="512" height="512" loading="lazy" decoding="async"
                                class="w-10">
                            <div>
                                <h3 class="font-semibold text-slate-800 text-base">Free Jasa Arsitek</h3>
                                <p>Dibantu rancang rumah dari awal tanpa bingung sendiri.</p>
                            </div>
                        </li>
                        <li
                            class="bg-white border border-neutral-200 p-4 rounded-xl leading-relaxed flex items-center gap-3 text-sm text-slate-600 hover:scale-105 hover:shadow-xl active:scale-105 active:shadow-xl transition-all duration-500">
                            <img src="<?= e(url('/assets/images/benefits/lokasi_strategis.png')) ?>"
                                alt="Ikon lokasi strategis" width="512" height="512" loading="lazy" decoding="async"
                                class="w-10">
                            <div>
                                <h3 class="font-semibold text-slate-800 text-base">Lokasi Strategis</h3>
                                <p>Dekat dengan aktivitas dan kebutuhan harian di Kota Medan.</p>
                            </div>
                        </li>
                        <li
                            class="bg-white border border-neutral-200 p-4 rounded-xl leading-relaxed flex items-center gap-3 text-sm text-slate-600 hover:scale-105 hover:shadow-xl active:scale-105 active:shadow-xl transition-all duration-500">
                            <img src="<?= e(url('/assets/images/benefits/fasilitas_premium.png')) ?>"
                                alt="Ikon fasilitas premium" width="512" height="512" loading="lazy" decoding="async"
                                class="w-10">
                            <div>
                                <h3 class="font-semibold text-slate-800 text-base">Fasilitas Premium</h3>
                                <p>Kawasan nyaman untuk hidup dan bertumbuh bersama keluarga.</p>
                            </div>
                        </li>
                        <li
                            class="bg-white border border-neutral-200 p-4 rounded-xl leading-relaxed flex items-center gap-3 text-sm text-slate-600 hover:scale-105 hover:shadow-xl active:scale-105 active:shadow-xl transition-all duration-500">
                            <img src="<?= e(url('/assets/images/benefits/bisa_kavling.png')) ?>"
                                alt="Ikon bisa mulai dari kavling" width="512" height="512" loading="lazy"
                                decoding="async" class="w-10">
                            <div>
                                <h3 class="font-semibold text-slate-800 text-base">Bisa Mulai dari Kavling</h3>
                                <p>Amankan tanahnya dulu, bangun rumahnya bisa menyusul.</p>
                            </div>
                        </li>
                        <li
                            class="bg-white border border-neutral-200 p-4 rounded-xl leading-relaxed flex items-center gap-3 text-sm text-slate-600 hover:scale-105 hover:shadow-xl active:scale-105 active:shadow-xl transition-all duration-500">
                            <img src="<?= e(url('/assets/images/benefits/bebas_banjir.png')) ?>" alt="Ikon bebas banjir"
                                width="512" height="512" loading="lazy" decoding="async" class="w-10">
                            <div>
                                <h3 class="font-semibold text-slate-800 text-base">Bebas Banjir</h3>
                                <p>Saluran air dan lingkungan kawasan dirawat secara berkala.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Fasilitas -->
        <section id="fasilitas" class="flex flex-col gap-8">
            <div class="flex flex-col gap-4 p-8">

                <h2 class="text-xl font-medium tracking-tight leading-snug text-center">Fasilitas apa aja di TASRI ?
                </h2>

                <div class="grid grid-cols-2 gap-4">
                    <div
                        class="flex flex-col gap-3 items-center justify-center text-center border border-slate-300 rounded-xl py-6 px-4 hover:scale-105 hover:shadow-xl active:scale-105 active:shadow-xl transition-all duration-500">
                        <img src="<?= e(url('/assets/images/facilities/security.png')) ?>" alt="Ikon sekuriti 24 jam"
                            width="512" height="512" loading="lazy" decoding="async" class="w-14">
                        <p class="text-xs sm:text-sm">Sekuriti 24 Jam</p>
                    </div>

                    <div
                        class="flex flex-col gap-3 items-center justify-center text-center border border-slate-300 rounded-xl py-6 px-4 hover:scale-105 hover:shadow-xl active:scale-105 active:shadow-xl transition-all duration-500">
                        <img src="<?= e(url('/assets/images/facilities/mosque.png')) ?>" alt="Ikon masjid" width="512"
                            height="512" loading="lazy" decoding="async" class="w-14">
                        <p class="text-xs sm:text-sm">Masjid</p>
                    </div>

                    <div
                        class="flex flex-col gap-3 items-center justify-center text-center border border-slate-300 rounded-xl py-6 px-4 hover:scale-105 hover:shadow-xl active:scale-105 active:shadow-xl transition-all duration-500">
                        <img src="<?= e(url('/assets/images/facilities/mart.png')) ?>" alt="Ikon minimarket" width="512"
                            height="512" loading="lazy" decoding="async" class="w-14">
                        <p class="text-xs sm:text-sm">Minimarket</p>
                    </div>

                    <div
                        class="flex flex-col gap-3 items-center justify-center text-center border border-slate-300 rounded-xl py-6 px-4 hover:scale-105 hover:shadow-xl active:scale-105 active:shadow-xl transition-all duration-500">
                        <img src="<?= e(url('/assets/images/facilities/club-house.png')) ?>" alt="Ikon club house"
                            width="512" height="512" loading="lazy" decoding="async" class="w-14">
                        <p class="text-xs sm:text-sm">Club House</p>
                    </div>

                    <div
                        class="flex flex-col gap-3 items-center justify-center text-center border border-slate-300 rounded-xl py-6 px-4 hover:scale-105 hover:shadow-xl active:scale-105 active:shadow-xl transition-all duration-500">
                        <img src="<?= e(url('/assets/images/facilities/swimpool.png')) ?>" alt="Ikon swimming pool"
                            width="512" height="512" loading="lazy" decoding="async" class="w-14">
                        <p class="text-xs sm:text-sm">Swimming Pool</p>
                    </div>

                    <div
                        class="flex flex-col gap-3 items-center justify-center text-center border border-slate-300 rounded-xl py-6 px-4 hover:scale-105 hover:shadow-xl active:scale-105 active:shadow-xl transition-all duration-500">
                        <img src="<?= e(url('/assets/images/facilities/football-field.png')) ?>"
                            alt="Ikon lapangan olahraga" width="512" height="512" loading="lazy" decoding="async"
                            class="w-14">
                        <p class="text-xs sm:text-sm">Lapangan Olahraga</p>
                    </div>

                </div>

            </div>
        </section>

        <!-- Testimoni -->
        <section id="testimoni" class="flex flex-col gap-4 py-8">
            <div class="px-8">
                <p class="text-sm font-semibold text-blue-700">Cerita TASRI</p>
                <h2 class="mt-2 text-xl font-medium tracking-tight leading-snug max-w-xs">
                    Lihat langsung pengalaman mereka tinggal di Taman Asoka Asri.
                </h2>
            </div>

            <div class="swiper tasri-swiper js-reels-testimoni-swiper" data-reels-wrapper></div>
        </section>

        <!-- USP -->
        <section class="flex flex-col gap-8 p-8 bg-slate-100">
            <div class="flex flex-col gap-3">
                <h2 class="text-xl font-medium tracking-tight leading-snug max-w-xs">Setiap keluarga tentu punya cerita
                    yang berbeda.</h2>
                <span
                    class="bg-slate-200 border border-slate-300 rounded-xl leading-relaxed text-sm text-slate-600 font-medium px-4 py-3">
                    Ada yang membutuhkan ruang untuk bekerja dari rumah.</span>
                <span
                    class="bg-slate-200 border border-slate-300 rounded-xl leading-relaxed text-sm text-slate-600 font-medium px-4 py-3">
                    Ada yang ingin dapur yang lebih lega.</span>
                <span
                    class="bg-slate-200 border border-slate-300 rounded-xl leading-relaxed text-sm text-slate-600 font-medium px-4 py-3">
                    Ada yang memimpikan halaman untuk anak-anak bermain.</span>

                <p class="text-sm sm:text-base leading-relaxed text-slate-600">
                    Itulah mengapa rumah terbaik bukan yang paling besar atau paling mewah, Tapi rumah yang dirancang
                    sesuai kebutuhan penghuninya 😍</p>

                <p class="text-sm sm:text-base leading-relaxed text-slate-600">
                    Di Taman Asoka Asri, kamu memiliki kebebasan untuk mewujudkan rumah yang benar-benar terasa seperti
                    rumahmu sendiri.</p>
            </div>

        </section>

        <section id="lead-form" class="flex flex-col gap-6 p-8 group">
            <div class="flex flex-col gap-3">
                <h2 class="text-xl font-medium tracking-tight leading-snug max-w-xs">Temukan Rumah yang Benar-Benar
                    Cocok
                    Untukmu
                </h2>
                <p class="text-sm sm:text-base leading-relaxed text-slate-600">Isi form di bawah ini dan tim kami akan
                    membantu mencarikan solusi hunian yang sesuai dengan kebutuhanmu. 👇👇</p>
            </div>
            <form method="post" action="<?= e(url('/lead')) ?>" data-lead-form data-pixel-event="Purchase"
                class="border border-slate-300 p-5 rounded-2xl shadow-2xl ring-2 ring-offset-2 ring-slate-300 group-hover:ring-blue-600 group-hover:shadow-blue-400 transition-all duration-300">
                <?php if (!empty($error)): ?>
                    <div class="mb-4 rounded-md border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-700">
                        <?= e($error) ?>
                    </div>
                <?php endif; ?>
                <div class="grid gap-4">
                    <?php component('form/input', ['name' => 'fullname', 'label' => 'Nama Lengkap', 'placeholder' => 'Masukkan Nama', 'value' => old('fullname'), 'required' => true]); ?>
                    <?php component('form/input', ['name' => 'whatsapp', 'label' => 'Nomor WhatsApp', 'placeholder' => 'No.Whatsapp Aktif', 'value' => old('whatsapp'), 'required' => true]); ?>
                    <?php component('form/input', ['name' => 'city', 'label' => 'Kota Domisili', 'placeholder' => 'Medan/Siantar/dll', 'value' => old('city'), 'required' => true]); ?>
                    <button type="submit" disabled data-lead-submit
                        class="bg-gradient-to-br from-green-600 to-green-700 flex items-center justify-center gap-2 cursor-pointer text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-800 active:bg-blue-900 disabled:cursor-not-allowed disabled:from-slate-300 disabled:to-slate-400 disabled:text-slate-500 active:bg-blue-900 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path
                                d="M7.25361 18.4944L7.97834 18.917C9.18909 19.623 10.5651 20 12.001 20C16.4193 20 20.001 16.4183 20.001 12C20.001 7.58172 16.4193 4 12.001 4C7.5827 4 4.00098 7.58172 4.00098 12C4.00098 13.4363 4.37821 14.8128 5.08466 16.0238L5.50704 16.7478L4.85355 19.1494L7.25361 18.4944ZM2.00516 22L3.35712 17.0315C2.49494 15.5536 2.00098 13.8345 2.00098 12C2.00098 6.47715 6.47813 2 12.001 2C17.5238 2 22.001 6.47715 22.001 12C22.001 17.5228 17.5238 22 12.001 22C10.1671 22 8.44851 21.5064 6.97086 20.6447L2.00516 22ZM8.39232 7.30833C8.5262 7.29892 8.66053 7.29748 8.79459 7.30402C8.84875 7.30758 8.90265 7.31384 8.95659 7.32007C9.11585 7.33846 9.29098 7.43545 9.34986 7.56894C9.64818 8.24536 9.93764 8.92565 10.2182 9.60963C10.2801 9.76062 10.2428 9.95633 10.125 10.1457C10.0652 10.2428 9.97128 10.379 9.86248 10.5183C9.74939 10.663 9.50599 10.9291 9.50599 10.9291C9.50599 10.9291 9.40738 11.0473 9.44455 11.1944C9.45903 11.25 9.50521 11.331 9.54708 11.3991C9.57027 11.4368 9.5918 11.4705 9.60577 11.4938C9.86169 11.9211 10.2057 12.3543 10.6259 12.7616C10.7463 12.8783 10.8631 12.9974 10.9887 13.108C11.457 13.5209 11.9868 13.8583 12.559 14.1082L12.5641 14.1105C12.6486 14.1469 12.692 14.1668 12.8157 14.2193C12.8781 14.2457 12.9419 14.2685 13.0074 14.2858C13.0311 14.292 13.0554 14.2955 13.0798 14.2972C13.2415 14.3069 13.335 14.2032 13.3749 14.1555C14.0984 13.279 14.1646 13.2218 14.1696 13.2222V13.2238C14.2647 13.1236 14.4142 13.0888 14.5476 13.097C14.6085 13.1007 14.6691 13.1124 14.7245 13.1377C15.2563 13.3803 16.1258 13.7587 16.1258 13.7587L16.7073 14.0201C16.8047 14.0671 16.8936 14.1778 16.8979 14.2854C16.9005 14.3523 16.9077 14.4603 16.8838 14.6579C16.8525 14.9166 16.7738 15.2281 16.6956 15.3913C16.6406 15.5058 16.5694 15.6074 16.4866 15.6934C16.3743 15.81 16.2909 15.8808 16.1559 15.9814C16.0737 16.0426 16.0311 16.0714 16.0311 16.0714C15.8922 16.159 15.8139 16.2028 15.6484 16.2909C15.391 16.428 15.1066 16.5068 14.8153 16.5218C14.6296 16.5313 14.4444 16.5447 14.2589 16.5347C14.2507 16.5342 13.6907 16.4482 13.6907 16.4482C12.2688 16.0742 10.9538 15.3736 9.85034 14.402C9.62473 14.2034 9.4155 13.9885 9.20194 13.7759C8.31288 12.8908 7.63982 11.9364 7.23169 11.0336C7.03043 10.5884 6.90299 10.1116 6.90098 9.62098C6.89729 9.01405 7.09599 8.4232 7.46569 7.94186C7.53857 7.84697 7.60774 7.74855 7.72709 7.63586C7.85348 7.51651 7.93392 7.45244 8.02057 7.40811C8.13607 7.34902 8.26293 7.31742 8.39232 7.30833Z">
                            </path>
                        </svg>
                        Hubungi Marketing
                    </button>
                </div>
            </form>
        </section>

        <!-- FAQs -->
        <section id="faqs" class="flex flex-col gap-4 p-8">
            <h2 class="text-xl font-medium tracking-tight leading-snug text-center">Masih Ada yang Ingin Ditanyakan?
            </h2>

            <div class="flex flex-col gap-3" data-accordion data-accordion-single="true"></div>
        </section>

        <!-- Footer -->
        <img src="<?= e(url('/assets/images/footer.png')) ?>" alt="Ilustrasi marketing office Taman Asoka Asri"
            width="1080" height="148" loading="lazy" decoding="async" draggable="false"
            class="w-full h-auto object-cover select-none pointer-events-none">
        <section class="flex flex-col gap-4 bg-[#050d57]">
            <div class="flex flex-col gap-2 px-8 pb-8 text-center text-white">
                <h2 class="text-2xl font-medium tracking-tight leading-snug">Kunjungi Marketing Office <br>
                    Taman Asoka Asri </h2>
                <p class="leading-relaxed text-sm max-w-xs mx-auto mb-2">Jl. Flamboyan Raya, Tj. Selamat, Kec. Medan
                    Tuntungan, Kota Medan.</p>
                <div class="flex justify-center items-center">
                    <a href="https://maps.app.goo.gl/QB7wxkriqLnmrttH7" target="_blank"
                        class="bg-yellow-400 rounded-lg px-4 py-2 text-sm font-medium transition-all duration-300 text-slate-900 hover:scale-105 active:scale-100">Visit
                        Us</a>
                </div>
            </div>

        </section>


        <div data-sticky-cta
            class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-md z-50 transition-all duration-300 bg-white/30 backdrop-blur-lg">
            <div class="flex items-center justify-between py-3 px-4">
                <div class="flex flex-col">
                    <h4 class="text-lg sm:text-xl font-medium tracking-tight">Info Harga & Brosur</h4>
                    <p class="text-xs sm:text-sm text-slate-600">Gratis Konsultasi!</p>
                </div>

                <a href="#lead-form"
                    class="flex items-center justify-between gap-3 bg-green-600 hover:bg-green-700 hover:scale-105 active:scale-100 text-sm sm:text-base text-white px-3 py-2 rounded-lg transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="size-6 shrink-0 opacity-90">
                        <path
                            d="M7.25361 18.4944L7.97834 18.917C9.18909 19.623 10.5651 20 12.001 20C16.4193 20 20.001 16.4183 20.001 12C20.001 7.58172 16.4193 4 12.001 4C7.5827 4 4.00098 7.58172 4.00098 12C4.00098 13.4363 4.37821 14.8128 5.08466 16.0238L5.50704 16.7478L4.85355 19.1494L7.25361 18.4944ZM2.00516 22L3.35712 17.0315C2.49494 15.5536 2.00098 13.8345 2.00098 12C2.00098 6.47715 6.47813 2 12.001 2C17.5238 2 22.001 6.47715 22.001 12C22.001 17.5228 17.5238 22 12.001 22C10.1671 22 8.44851 21.5064 6.97086 20.6447L2.00516 22ZM8.39232 7.30833C8.5262 7.29892 8.66053 7.29748 8.79459 7.30402C8.84875 7.30758 8.90265 7.31384 8.95659 7.32007C9.11585 7.33846 9.29098 7.43545 9.34986 7.56894C9.64818 8.24536 9.93764 8.92565 10.2182 9.60963C10.2801 9.76062 10.2428 9.95633 10.125 10.1457C10.0652 10.2428 9.97128 10.379 9.86248 10.5183C9.74939 10.663 9.50599 10.9291 9.50599 10.9291C9.50599 10.9291 9.40738 11.0473 9.44455 11.1944C9.45903 11.25 9.50521 11.331 9.54708 11.3991C9.57027 11.4368 9.5918 11.4705 9.60577 11.4938C9.86169 11.9211 10.2057 12.3543 10.6259 12.7616C10.7463 12.8783 10.8631 12.9974 10.9887 13.108C11.457 13.5209 11.9868 13.8583 12.559 14.1082L12.5641 14.1105C12.6486 14.1469 12.692 14.1668 12.8157 14.2193C12.8781 14.2457 12.9419 14.2685 13.0074 14.2858C13.0311 14.292 13.0554 14.2955 13.0798 14.2972C13.2415 14.3069 13.335 14.2032 13.3749 14.1555C14.0984 13.279 14.1646 13.2218 14.1696 13.2222V13.2238C14.2647 13.1236 14.4142 13.0888 14.5476 13.097C14.6085 13.1007 14.6691 13.1124 14.7245 13.1377C15.2563 13.3803 16.1258 13.7587 16.1258 13.7587L16.7073 14.0201C16.8047 14.0671 16.8936 14.1778 16.8979 14.2854C16.9005 14.3523 16.9077 14.4603 16.8838 14.6579C16.8525 14.9166 16.7738 15.2281 16.6956 15.3913C16.6406 15.5058 16.5694 15.6074 16.4866 15.6934C16.3743 15.81 16.2909 15.8808 16.1559 15.9814C16.0737 16.0426 16.0311 16.0714 16.0311 16.0714C15.8922 16.159 15.8139 16.2028 15.6484 16.2909C15.391 16.428 15.1066 16.5068 14.8153 16.5218C14.6296 16.5313 14.4444 16.5447 14.2589 16.5347C14.2507 16.5342 13.6907 16.4482 13.6907 16.4482C12.2688 16.0742 10.9538 15.3736 9.85034 14.402C9.62473 14.2034 9.4155 13.9885 9.20194 13.7759C8.31288 12.8908 7.63982 11.9364 7.23169 11.0336C7.03043 10.5884 6.90299 10.1116 6.90098 9.62098C6.89729 9.01405 7.09599 8.4232 7.46569 7.94186C7.53857 7.84697 7.60774 7.74855 7.72709 7.63586C7.85348 7.51651 7.93392 7.45244 8.02057 7.40811C8.13607 7.34902 8.26293 7.31742 8.39232 7.30833Z" />
                    </svg>
                    Hubungi Sekarang
                </a>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js" defer></script>
    <script src="<?= e(url('/assets/js/components/harvestGallery.js')) ?>?v=5" defer></script>
    <script src="<?= e(url('/assets/js/components/reelsTestimoni.js')) ?>?v=3" defer></script>
    <script src="<?= e(url('/assets/js/components/swiper.js')) ?>?v=6" defer></script>
    <script src="<?= e(url('/assets/js/components/leadFormPixel.js')) ?>?v=2" defer></script>
    <script src="<?= e(url('/assets/js/components/accordion.js')) ?>?v=2" defer></script>
    <script src="<?= e(url('/assets/js/components/stickyCta.js')) ?>?v=1" defer></script>
</body>

</html>