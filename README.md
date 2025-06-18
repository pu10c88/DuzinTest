# MESTRE + FORMAÇÃO GESTOR - Landing Page

A complete, responsive HTML5 landing page built with Hugo for capturing leads and promoting automation training courses.

## 🚀 Features

- ✅ **Contact form in the first fold** (above the fold)
- ✅ **Popup contact form** triggered by CTA buttons
- ✅ **Thank you page** with bonus content
- ✅ **Custom head scripts** support (Google Tag Manager, Facebook Pixel)
- ✅ **YouTube video** embedded
- ✅ **Responsive design** (mobile-friendly)
- ✅ **Professional modern design** with animations
- ✅ **Easy to edit** content and images
- ✅ **SEO optimized** with meta tags
- ✅ **Form validation** and user feedback

## 📁 File Structure

```
metrodosbotsreplica/
├── layouts/
│   └── index.html          # Main landing page template
├── static/
│   └── thanks.html         # Thank you page (static)
├── hugo.toml              # Hugo configuration
└── README.md              # This file
```

## 🛠️ Setup & Usage

### 1. Start Hugo Server
```bash
hugo server --bind 0.0.0.0 --port 1313
```

### 2. Access Your Site
- **Main Page**: http://localhost:1313
- **Thank You Page**: http://localhost:1313/thanks.html

### 3. Deploy to Production
```bash
hugo --minify
```

## 🎨 Customization Guide

### 📝 Edit Content

#### Main Headline & Subheadings
Edit in `layouts/index.html`:
```html
<h1 class="hero-title">Mestre + Formação Gestor</h1>
<h2 class="hero-subtitle">R$ 421.700 EM PROJETOS VENDIDOS</h2>
```

#### Results Section
```html
<h2 class="results-title">Não existe mágica, nem milagre</h2>
<p class="results-description">
    Aprenda automações que resolvem <span class="results-highlight">problemas reais</span> de empresas
</p>
```

### 🎥 YouTube Video

Replace `YOUR_VIDEO_ID_HERE` with your actual YouTube video ID:
```html
<iframe src="https://www.youtube.com/embed/YOUR_VIDEO_ID_HERE">
```

### 🖼️ Images & Testimonials

Replace placeholder images in the testimonials section:
```html
<img src="https://via.placeholder.com/200x250/333/fff?text=Depoimento+1" alt="Depoimento de aluno sucesso">
```

Replace with your actual testimonial images:
```html
<img src="/images/testimonial-1.jpg" alt="João Silva - Aluno de sucesso">
```

### 📧 Form Handling

#### Option 1: Backend API
Edit the `submitForm` function in `layouts/index.html`:
```javascript
fetch('/api/submit-lead', {
    method: 'POST',
    body: formData
})
```

#### Option 2: Third-party Services
- **Formspree**: `action="https://formspree.io/f/YOUR_FORM_ID"`
- **Netlify Forms**: Add `netlify` attribute to form
- **Zapier**: Use Zapier webhooks

### 📊 Analytics Integration

#### Google Tag Manager
Replace `GTM-XXXXXXX` with your GTM ID in the head section:
```html
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-XXXXXXX');</script>
```

#### Facebook Pixel
Replace `XXXXXXXXXXXXXXXXX` with your Pixel ID:
```html
<script>fbq('init','XXXXXXXXXXXXXXXXX');fbq('track','PageView');</script>
```

### 🎨 Colors & Styling

Main brand colors defined in CSS:
```css
:root {
    --primary-gold: #f1c40f;
    --secondary-gold: #f39c12;
    --dark-bg: #000;
    --light-bg: #111;
}
```

## 📱 Responsive Breakpoints

- **Desktop**: 1200px+
- **Tablet**: 768px - 1199px
- **Mobile**: 480px - 767px
- **Small Mobile**: < 480px

## 🔧 Hugo Configuration

Edit `hugo.toml`:
```toml
baseURL = 'https://yourdomain.com/'
languageCode = 'pt-br'
title = 'MESTRE + FORMAÇÃO GESTOR - Automações que Geram Resultados'
```

## 📈 Performance Optimization

### 1. Image Optimization
- Use WebP format for images
- Compress images before uploading
- Use appropriate image sizes

### 2. CSS & JS Minification
Hugo automatically minifies when using `hugo --minify`

### 3. CDN Integration
Consider using a CDN for faster global loading

## 🚀 Deployment Options

### 1. Netlify
```bash
# Build command
hugo --minify

# Publish directory
public
```

### 2. Vercel
```bash
# Build command
hugo --minify

# Output directory
public
```

### 3. GitHub Pages
```bash
# Use GitHub Actions with Hugo
```

## 📧 Lead Capture Setup

### CRM Integration Examples:

#### HubSpot
```javascript
// Add to form submission
fetch('https://api.hubspot.com/contacts/v1/contact/', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer YOUR_API_KEY'
    },
    body: JSON.stringify({
        'properties': [
            {'property': 'email', 'value': email},
            {'property': 'firstname', 'value': name}
        ]
    })
});
```

#### Mailchimp
```javascript
// Add to form submission
fetch('https://YOUR_DOMAIN.us1.list-manage.com/subscribe/post-json?u=YOUR_USER_ID&id=YOUR_LIST_ID', {
    method: 'POST',
    mode: 'no-cors',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({
        'EMAIL': email,
        'FNAME': name
    })
});
```

## 🎯 Marketing Features

### A/B Testing
- Test different headlines
- Test different CTA button texts
- Test different form positions

### Conversion Tracking
- Google Analytics events
- Facebook Pixel events
- Custom conversion goals

### Lead Magnets
- Free PDF downloads
- Email course sequences
- Bonus video content

## 🔐 Security

- Form validation on both client and server
- CSRF protection for forms
- Rate limiting for form submissions
- Input sanitization

## 📞 Support

For technical support or customization requests, contact the development team.

## 📄 License

This landing page template is provided for the MESTRE + FORMAÇÃO GESTOR project.

---

**Built with ❤️ using Hugo & HTML5** 