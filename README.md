# Testimonials Masonry Grid

A lightweight WordPress plugin that displays testimonials in a beautiful, responsive masonry grid layout using WordPress' built-in Masonry library.

## Features

- **Custom Post Type**: Dedicated "Testimonials" post type with Gutenberg support
- **Responsive Masonry Layout**: Automatic grid layout that adapts to screen size
- **Flexible Columns**: Support for 1-6 columns on desktop
- **Avatar Support**: Display client photos with circular styling
- **Custom Fields**: Optional client role and company metadata
- **Clean Design**: Minimal, modern styling with subtle shadows and borders
- **RTL Support**: Automatic right-to-left language support
- **Accessibility**: Semantic HTML with proper ARIA labels
- **Performance**: Uses WordPress core libraries (no external dependencies)

## Installation

1. Download or clone this repository
2. Upload the `testimonials-masonry-grid` folder to `/wp-content/plugins/`
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Add testimonials via the new "Testimonials" menu in your WordPress admin

## Usage

### Basic Shortcode

Display testimonials using the shortcode:

```
[testimonials_masonry]
```

### Shortcode Parameters

| Parameter | Default | Description |
|-----------|---------|-------------|
| `posts_per_page` | `12` | Number of testimonials to display |
| `order` | `DESC` | Sort order (`ASC` or `DESC`) |
| `orderby` | `date` | Sort by field (e.g., `date`, `title`, `rand`) |
| `columns` | `4` | Number of columns on desktop (1-6) |
| `id` | _(empty)_ | Specific testimonial ID(s) to display (comma-separated) |

### Examples

**Display 20 testimonials in 3 columns:**
```
[testimonials_masonry posts_per_page="20" columns="3"]
```

**Show random testimonials:**
```
[testimonials_masonry orderby="rand" posts_per_page="9"]
```

**Single column layout:**
```
[testimonials_masonry columns="1"]
```

**Display a specific testimonial by ID:**
```
[testimonials_masonry id="123"]
```

**Display multiple specific testimonials:**
```
[testimonials_masonry id="123,456,789"]
```

**Display specific testimonial in single column:**
```
[testimonials_masonry id="123" columns="1"]
```

## Adding Testimonials

1. Go to **Testimonials > Add New** in WordPress admin
2. **Title**: Enter the client's name
3. **Content**: Enter the testimonial quote/text
4. **Featured Image**: Upload the client's photo (optional)
5. **Custom Fields** (optional):
   - `client_role`: Client's job title
   - `client_company`: Client's company name

The citation will automatically format as: `Client Name · Role · Company`

## Responsive Breakpoints

The grid automatically adjusts columns based on screen width:

- **Desktop** (>1024px): Uses your specified column count (1-6)
- **Tablet** (≤1024px): 3 columns
- **Mobile** (≤768px): 2 columns
- **Small Mobile** (≤520px): 1 column

## Styling

The plugin uses these main CSS classes:

- `.tm-wrap`: Main container
- `.tm-grid`: Masonry grid container
- `.tm-item`: Individual testimonial card
- `.tm-avatar`: Client photo (circular, 64px height)
- `.tm-quote`: Testimonial text content
- `.tm-cite`: Client attribution footer

### Customization

To customize styling, add CSS to your theme:

```css
/* Example: Change card background */
.tm-item {
    background: #f9f9f9;
}

/* Example: Adjust avatar size */
.tm-avatar {
    height: 80px;
}

/* Example: Change quote text color */
.tm-quote {
    color: #333;
}
```

## Technical Details

- **WordPress Version**: 5.0+
- **PHP Version**: 7.0+
- **Dependencies**: WordPress core Masonry & imagesLoaded libraries
- **Post Type Slug**: `testimonial`
- **Supports**: Title, Editor, Featured Image, Excerpt

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Changelog

### 1.0.0
- Initial release
- Custom post type registration
- Masonry grid shortcode
- Responsive layout
- Avatar support
- Custom fields for role and company

## Credits

- **Author**: Shawn Kelshaw / Windsurf
- **Masonry**: WordPress core library
- **Font**: IBM Plex Sans

## License

This plugin is provided as-is for use in WordPress projects.

## Support

For issues, questions, or contributions, please visit the [GitHub repository](https://github.com/shawnkelshaw/testimonials-masonry-grid).
