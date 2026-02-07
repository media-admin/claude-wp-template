// Import CSS
import '../scss/style.scss';

// Swiper Import
import Swiper from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

window.Swiper = Swiper;

// Components
import HeroSlider from './components/hero-slider';
import Accordion from './components/accordion';
import BackToTop from './components/back-to-top';
import CookieNotice from './components/cookie-notice';
import FAQAccordion from './components/faq-accordion';
import DarkMode from './components/theme-switcher';
import ImageComparison from './components/image-comparison';
import Lightbox from './components/lightbox';
import LogoCarousel from './components/logo-carousel';
import Modal from './components/modal';
import Navigation from './components/navigation';
import Notifications from './components/notifications';
import ScrollAnimations from './components/scroll-animations';
import Spoiler from './components/spoiler';
import StatsCounter from './components/stats-counter';
import Tabs from './components/tabs';
import TestimonialsSlider from './components/testimonials-slider';
import VideoPlayer from './components/video-player';

// Theme loaded
console.log('✨ Custom Theme loaded with Vite + Autoprefixer');