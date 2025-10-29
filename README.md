# Twig Ticket Management App

A simple ticket management system built with PHP and Twig templating engine, featuring a clean UI with Tailwind CSS.

## Features

- **Ticket CRUD Operations**: Create, view, edit, and delete support tickets
- **Status Tracking**: Track ticket status (Open, In Progress, Closed) with color-coded badges
- **Responsive Design**: Mobile-friendly interface using Tailwind CSS
- **Custom Toast Notifications**: Elegant confirmation dialogs for delete operations
- **Session-Based Storage**: Uses PHP sessions for data persistence (no database required)
- **Simple Routing**: Query parameter-based navigation between pages

## How It Works

### Architecture
- **Backend**: PHP handles routing, form submissions, and session management
- **Frontend**: Twig templates render the UI with dynamic data
- **Styling**: Tailwind CSS provides responsive, modern styling
- **Data Storage**: PHP sessions store ticket data in memory

### Key Components

1. **index.php**: Main entry point handling routing and ticket operations
2. **Templates**:
   - `home.twig`: Landing page
   - `dashboard.twig`: Dashboard view
   - `authentication.twig`: Login/signup forms
   - `ticketmanagement.twig`: Main ticket management interface
3. **Ticket Operations**:
   - **Create**: Form submission adds new tickets to session
   - **Read**: Tickets displayed in a list with status and metadata
   - **Update**: Edit button populates form for modifications
   - **Delete**: Custom toast confirmation before removal

### Data Flow

1. User navigates to `?page=tickets`
2. PHP loads tickets from session and passes to Twig template
3. Template renders ticket list and form
4. Form submissions trigger POST requests to update session data
5. Page redirects to refresh display

### Toast Notifications

Delete operations use custom JavaScript toast notifications instead of browser alerts:
- Appears in bottom-right corner
- Includes confirm/cancel buttons
- Auto-hides after 5 seconds
- Styled with Tailwind CSS

## Installation

1. **Prerequisites**:
   - PHP 7.4 or higher
   - Composer (for Twig dependency)
   - Web server (Apache/Nginx) or PHP built-in server

2. **Setup**:
   ```bash
   cd /path/to/project
   composer install
   php -S localhost:8000 index.php
   ```

3. **Access**: Open `http://localhost:8000` in your browser

## Usage

1. **Navigation**: Use query parameters to navigate:
   - `?page=home` - Home page
   - `?page=dashboard` - Dashboard
   - `?page=login` - Authentication
   - `?page=tickets` - Ticket management

2. **Managing Tickets**:
   - Click "Create Ticket" to add new tickets
   - Use "Edit" button to modify existing tickets
   - Click "Delete" to remove tickets (with confirmation)
   - Status updates reflect immediately in the UI

## Technologies Used

- **PHP**: Server-side logic and session management
- **Twig**: Template engine for dynamic HTML rendering
- **Tailwind CSS**: Utility-first CSS framework
- **JavaScript**: Client-side interactions (toast notifications, form handling)

## Project Structure

```
twig-ticket-management-app/
├── index.php                 # Main application file
├── composer.json            # PHP dependencies
├── README.md                # This file
└── templates/
    ├── index.html.twig      # Base template
    └── components/
        ├── home.twig        # Home page
        ├── dashboard.twig   # Dashboard
        ├── authentication.twig # Login/signup
        └── ticketmanagement.twig # Ticket management
```

## Notes

- Data persists only during the session; restarting the server clears all tickets
- For production use, consider replacing session storage with a database
- The app demonstrates Twig templating and PHP session handling for small-scale applications
