USE [db_api]
GO
/****** Object:  Table [dbo].[api]    Script Date: 6/21/2017 8:48:42 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[api](
	[journalnum] [bigint] NULL,
	[accounttype] [bigint] NULL,
	[account] [bigint] NULL,
	[company] [nchar](100) NULL,
	[text] [text] NULL,
	[debit] [bigint] NULL,
	[currency] [nchar](10) NULL,
	[exchrate] [int] NULL,
	[department] [int] NULL,
	[costcenter] [int] NULL,
	[purpose] [int] NULL,
	[voucher] [bigint] NULL,
	[credit] [int] NULL,
	[date] [date] NULL,
	[transactiontype] [nchar](100) NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
