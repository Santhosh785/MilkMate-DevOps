// _Time.js
import { useState, useEffect } from 'react';

const useCurrentDate = () => {
    const [now, setNow] = useState(new Date());

    useEffect(() => {
        const update = () => setNow(new Date());
        const midnight = new Date();
        midnight.setHours(24, 0, 0, 0);
        const msUntilMidnight = midnight - new Date();

        const timer = setTimeout(update, msUntilMidnight);
        return () => clearTimeout(timer);
    }, [now]);

    const dayName = now.toLocaleDateString("en-US", { weekday: "long" });
    const dateString = now.toLocaleDateString("en-US", {
        month: "long",
        day: "numeric",
        year: "numeric",
    });

    return { dayName, dateString };
};

export default useCurrentDate;
