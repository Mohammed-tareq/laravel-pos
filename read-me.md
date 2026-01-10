feat: Introduce JavaScript components for handling modals, resizing, and chart utilities in Filament widgets and actions modules

- Added filament action modals handling script to synchronize and manage modal states.
- Implemented filament actions schema with sticky component logic and resize observer functionality.
- Introduced stats overview chart utility script with color utilities and helper functions.
- feat: Implement unified Livewire components and views for creating and managing customers, users, items, and payment methods

- Added `Create` Livewire components and Blade templates for customers, items, users, and payment methods.
- Integrated form validation, relationships, and notifications for record creation and updates.
- Enhanced list components with header actions, edit options, and toggleable columns.
- Updated migrations and seeders for unique constraints and scalable seed data.
- Refined sidebar navigation icons for better UI distinction.
- feat: Add Livewire POS module with integrated UI and functionality

- Introduced `Pos` Livewire component and associated Blade template for managing product sales.
- Added features for product listing, cart management, checkout process, and dynamic calculations (subtotal, tax, discount, and total).
- Integrated customer and payment method selection with real-time data updates.
- Updated sidebar navigation and routes to include POS management.
- feat: Add widgets, receipt printing, and image support for items

- Added `SalesChart`, `SalesItemsChart`, and `DataList` widgets to dashboard.
- Created `pdf.blade.php` template for receipt generation and printing.
- Enhanced item functionalities with image upload, storage, and display in POS.
- Updated item database schema to include `image` field and adjusted pricing precision.
- Refined POS checkout process with receipt preview and dynamic printing option.