import './Footer.css';


const _Footer = () => {
    return (
        <footer className="footer">
            <div className="footer-content">
                {/* Quick Links */}
                <div className="footer-section">
                    <h3>Quick Links</h3>
                    <a href="/">Home</a>
                    <a href="/calculate">Calculate Milk</a>
                    <a href="/payments">Payment History</a>
                    <a href="/rates">Milk Rates</a>
                </div>

                {/* Contact Info */}
                <div className="footer-section">
                    <h3>Contact Us</h3>
                    <p>📞 +91 9876543210</p>
                    <p>📧 milkmate@example.com</p>
                    <p>🏠 Dairy Farm, Village, State - PIN</p>
                </div>

                {/* Payment Methods */}
                <div className="footer-section">
                    <h3>Payment Options</h3>
                    <p>💵 Cash</p>
                    <p>📱 UPI: milkmate@upi</p>
                    <p>🏦 Bank Transfer</p>
                    <div className="payment-methods">
                        <img src="https://via.placeholder.com/40" alt="UPI" />
                        <img src="https://via.placeholder.com/40" alt="Bank" />
                    </div>
                </div>
            </div>

            {/* Copyright */}
            <div className="footer-bottom">
                <p>&copy; {new Date().getFullYear()} MilkMate - Daily Milk Tracker</p>
                <p>Designed for local dairy farmers & customers</p>
            </div>
        </footer>
    );
};

export default _Footer;