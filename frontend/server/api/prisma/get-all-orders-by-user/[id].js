import { PrismaClient } from '@prisma/client';
const prisma = new PrismaClient();

export default defineEventHandler(async (event) => {
    const { userId } = getQuery(event); // Lấy userId từ query parameters

    try {
        const orders = await prisma.orders.findMany({
            where: { userId },
            include: { 
                orderItem: {
                    include: {
                        product: true
                    }
                }
            }
        });

        return orders;
    } catch (error) {
        console.error('Failed to fetch orders:', error);
        throw createError({
            statusCode: 500,
            statusMessage: 'Failed to fetch orders'
        });
    }
});
