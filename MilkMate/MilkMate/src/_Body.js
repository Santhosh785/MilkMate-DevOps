import { FaPlus } from 'react-icons/fa6';

const _Body = ({ dayName, dateString, quantity, setQuantity }) => {
    const handleChange = (item, time, value) => {
        setQuantity((prev) => ({
            ...prev,
            [item]: {
                ...prev[item],
                [time]: parseInt(value) || 0,
            },
        }));
    };

    const data = [
        { name: 'TM 500', price: 20.0 },
        { name: 'SGM 450', price: 25.0 },
        { name: 'COW 500', price: 22.0 },
        { name: 'COW 200', price: 10.0 },
        { name: 'FCM 500', price: 30.0 },
        { name: 'FCM 1000', price: 60.0 },
        { name: 'Curd 120', price: 8.3 },
        { name: 'Curd 500', price: 31.91 },
        { name: 'Curd 5000', price: 354.36 },
    ];

    const calculateSubtotal = (item) => {
        const morningQty = quantity[item.name]?.morning || 0;
        const eveningQty = quantity[item.name]?.evening || 0;
        return ((morningQty + eveningQty) * item.price).toFixed(2);
    };

    const calculateTotal = () => {
        return data.reduce((sum, item) => {
            const morningQty = quantity[item.name]?.morning || 0;
            const eveningQty = quantity[item.name]?.evening || 0;
            return sum + (morningQty + eveningQty) * item.price;
        }, 0);
    };

    return (
        <main>
            <div className="header-container">
                <div className="date-info">
                    <h1>{dayName}</h1>
                    <h2>{dateString}</h2>
                </div>

                <div className="total-group">
                    <div className="total-display">
                        Pay ₹ {calculateTotal().toFixed(2)}
                    </div>

                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Mor</th>
                        <th>Eve</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    {data.map((item) => (
                        <tr key={item.name}>
                            <td>{item.name}</td>
                            <td>₹{item.price.toFixed(2)}</td>
                            <td>
                                <input
                                    type="number"
                                    value={quantity[item.name]?.morning || ''}
                                    onChange={(e) => handleChange(item.name, 'morning', e.target.value)}
                                />
                            </td>
                            <td>
                                <input
                                    type="number"
                                    value={quantity[item.name]?.evening || ''}
                                    onChange={(e) => handleChange(item.name, 'evening', e.target.value)}
                                />
                            </td>
                            <td>₹{calculateSubtotal(item)}</td>
                        </tr>
                    ))}
                </tbody>
            </table>

            <button className="submit" type="submit" aria-label="Add Item">
                <FaPlus />
            </button>
        </main>
    );
};

export default _Body;