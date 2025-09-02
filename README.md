# 📺 Sima for TV Android

A simple **Laravel + Tailwind** application for displaying announcements, prayer schedules, and scrolling text (**marquee**) on **Android TV / Smart TV** screens.  
This project is useful for mosques, organizations, or community boards that want to show live information on big screens.

## ✨ Features
- 🕌 **Prayer Schedule** – automatically displays daily prayer times.  
- 📢 **Announcements** – manage announcements via admin panel.  
- 🔔 **Scrolling Text (Marquee)** – powered by **TailwindCSS + tailwindcss-animated**, with fallback JavaScript for Android TV compatibility.  
- 📆 **Hijri Calendar** – auto-updated Islamic calendar display.  
- ⚡ **Optimized for TV** – works even on Android TV browsers where `<marquee>` is not supported.  

## 🛠️ Tech Stack
- [Laravel 10+](https://laravel.com/) – backend & Blade templates  
- [Tailwind CSS](https://tailwindcss.com/) – styling  
- [tailwindcss-animated](https://tailwindcss-animated.vercel.app/) – smooth animations  
- JavaScript (`requestAnimationFrame`) – fallback for TVs with limited CSS animation support  